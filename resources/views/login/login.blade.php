<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/k0munitat_imagotip.ico') }}" type="image/x-icon"/>


    <title>Login</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <style>
        .eye-icon {
            cursor: pointer;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-white-500">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div
            class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full max-w-md text-center">
            <!-- Logo -->
            <img src="{{ asset('img/logo.png') }}" alt="K0munitat Logo" class="mx-auto mb-10" style="max-width: 250px;">
            <form method="POST" action="{{ route('inicia-sesion') }}">
                @if (Session::get('fail'))
                    <div class="mb-5" style="color: red;">
                        {{ Session::get('fail') }}
                    </div>
                @endif

                @csrf
                <!-- Campo de email -->
                <div class="mb-4 relative">
                    <input autocomplete="off" id="email" name="email" type="text"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Email address" />
                    <label for="email"
                        class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email
                        Address</label>
                    @error('email')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Campo de contraseña -->
                <div class="mb-4 relative">
                    <input autocomplete="off" id="password" name="password" type="password"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Password" />
                    <label for="password"
                        class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                    @error('password')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                    <!-- Icono de ojo -->
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 eye-icon" id="togglePassword">
                        <i class="far fa-eye text-gray-600"></i>
                    </div>
                </div>
                <div class="mb-4">
                    <a href="{{ route('auth.redirect1') }}"
                        class="w-full bg-red-600 text-white rounded-md px-2 py-1 block">
                        <i class="fab fa-google mr-2"></i> Log in with Google
                    </a>
                </div>
                <!-- Botón de iniciar sesión con Facebook -->
                <div class="mb-4">
                    <a href="{{ route('auth.redirect') }}"
                        class="w-full bg-blue-600 text-white rounded-md px-2 py-1 block">
                        <i class="fab fa-facebook-square mr-2"></i> Log in with Facebook
                    </a>
                </div>

                <!-- Checkbox "Remember me" -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="rememberCheck" name="remember" class="mr-2">
                    <label for="rememberCheck" class="text-gray-600 text-sm">Remember me</label>
                </div>
                <!-- Olvidaste tu contraseña -->
                <div class="mb-4">
                    <a href="{{ route('resetPasswordView') }}" class="text-yellow-500 text-sm hover:underline">Forgot
                        your
                        password?</a>
                </div>
                <!-- Botón de enviar -->
                <div class="relative mb-4">
                    <button type="submit" class="w-full bg-yellow-500 text-white rounded-md px-2 py-1">Submit</button>
                </div>
            </form>

            <!-- Enlace para registrarse -->
            <p class="text-gray-600 text-sm mt-4">
                Don't have an account? <a href="{{ route('RegisterView') }}"
                    class="text-yellow-500 hover:underline">Create a new one</a>
            </p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Cambiamos los iconos estáticos
                if (type === 'password') {
                    togglePassword.innerHTML = '<i class="far fa-eye"></i>';
                } else {
                    togglePassword.innerHTML = '<i class="far fa-eye-slash"></i>';
                }
            });
        });
    </script>

</body>

</html>
