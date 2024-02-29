<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    //Retornar la vista del Login
    public function LoginView()
    {
        return view('login.login');
    }
    //Retornar la vista de Registrar 
    public function RegisterView()
    {
        return view('login.register');
    }

    //Retornar la vista de Registrar 
    public function resetPasswordView()
    {
        return view('login.resetPassword');
    }

    public function resetFormView(Request $request, $token = null)
    {
        return view('login.resetPasswordForm')->with(['token' => $token, 'email' => $request->email]);
    }

    //Funcio per a registrar un usuari
    function register(Request $request)
    {
        // Validación de las datos introducidos en el formulario
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ]);

        // Creación de un nuevo usuario
        $user = new User();

        // Asignación de los valores del formulario al usuario
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Guardar el usuario en la base de datos
        $user->save();

        // Redireccionar al formulario de inicio de sesión con los valores anteriores
        return redirect(route('LoginView'))->withInput($request->except('password', 'password_confirm'));
    }



    //Funció per fer login

    function login(Request $request)
    {
        // Validar las credenciales del usuario
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        // Credenciales del usuario
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        // Determinar si la casilla de "remember" está marcada
        $remember = $request->has('remember');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials, $remember)) {
            // Regenerar la sesión para evitar el riesgo de sesiones secundarias
            $request->session()->regenerate();

            // Verificar si el usuario tiene el rol "superAdmin"
            if (Auth::user()->role === 'superAdmin') {
                // Si es "superAdmin", redirigir al panel de administración
                // return redirect('/adminPanel');
                return redirect('/');
            } else {
                // Si no es "superAdmin", redirigir a la ruta privada
                return redirect()->intended(route('privada'));
            }
        } else {
            // Si las credenciales no son correctas, redirigir al login con un mensaje de error
            return redirect('/login')->with(['fail' => 'Invalid email or password.'])->withInput();
        }
    }



    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('LoginView'));
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $action_link = route('resetFormView', ['token' => $token, 'email' => $request->email]);
        $body = "We have recieved a request to reset the password for K0munitat account associated with " . $request->email .
            ". You can reset your password by clicking the link below.";

        Mail::send('email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('noreply@k0munitat.com', 'K0munitat');
            $message->to($request->email, 'user Name')
                ->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$check_token) {
            return back()->withInput()->with('fail', 'Invalid token');
        } else {
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'email' => $request->email
            ])->delete();

            return redirect()->route('LoginView')->with('info', 'Your password has been changed! You can login with new password');
        }
    }

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
        $user = User::firstOrCreate(
            ['email' => $user->email],
            [
                'username' => $user->name,
            ]
        );


        auth()->login($user);

        return redirect()->to('/');
    }

    public function Redirect1()
    {
        return Socialite::driver('google')->redirect();
    }

    public function Callback1()
    {
        // Obtén los datos del usuario de Google
        $user_google = Socialite::driver('google')->user();

        // Busca un usuario existente en la base de datos por su correo electrónico
        $user = User::where('email', $user_google->email)->first();

        // Si el usuario no existe, créalo
        if (!$user) {
            $user = User::create([
                'username' => $user_google->name,
                'email' => $user_google->email,
                'p'
            ]);
        }

        // Inicia sesión con el usuario
        Auth::login($user);

        // Redirige a la página principal
        return redirect('/');
    }
}
