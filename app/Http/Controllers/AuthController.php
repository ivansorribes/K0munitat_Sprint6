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

    public function resetFormView(Request $request, $token = null){
        return view('login.resetPasswordForm')->with(['token'=>$token, 'email'=>$request->email]);
    }

    //Funcio per a registrar un usuari
    function register(Request $request)
    {
        //Validació de les dades introduïdes en el formulari

        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->city = $request->city;
        $user->postcode = $request->postcode;
        $user->telephone = $request->telephone;
        $user->profile_description = $request->profile_description;


        $user->save();

        return redirect(route('LoginView'));

    }

    function login(Request $request) 
    {
        //Validació de les dades

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,   
        ];

        $remember = ($request->has('remember') ? true : false);
        
        if(Auth::attempt($credentials,$remember)){

            $request->session()->regenerate();

            return redirect()->intended(route('privada'));

        }else{
            return redirect('/login');
        }
    }

    function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('LoginView'));

    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);

        $action_link = route('resetFormView',['token'=>$token,'email'=>$request->email]);
        $body = "We have recieved a request to reset the password for K0munitat account associated with ".$request->email.
        ". You can reset your password by clicking the link below.";

        Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
            $message->from('noreply@k0munitat.com', 'K0munitat');
            $message->to($request->email, 'user Name')
                    ->subject('Reset Password');
        }); 

        return back()->with('success', 'We have e-mailed your password reset link');
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid token');
        }else{
            User::where('email', $request->email)->update([
                'password'=>Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('LoginView')->with('info', 'Your password has been changed! You can login with new password');
        }

    }
}