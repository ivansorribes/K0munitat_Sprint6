<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

</head>

<body class="min-h-screen flex items-center justify-center bg-white-500">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full max-w-md text-center">
            <!-- Logo -->
            <img src="{{ asset('img/Logo_K0munitat-removebg-preview.png') }}" alt="K0munitat Logo" class="mx-auto mb-10" style="max-width: 250px;">

            <!-- Forgot Password Content -->
            <div class="mb-8 text-gray-900">
                <p class="text-lg font-semibold mb-4">Forgot your Password?</p>
                <p class="text-sm">No problem, please provide your email address associated with your account, and we will send you a link to reset your password.</p>
            </div>

            <!-- Forgot Password Form -->
            <form method="POST" action="{{route('forgot.password.link')}}" autocomplete="off">
                @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{Session::get('fail')}}
                    </div>
                @endif

                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif

                @csrf
                <div class="mb-4 relative">
                    <input autocomplete="off" id="email" name="email" type="text"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Email address" value="{{old('email')}}" />
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    <label for="email"
                        class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email
                        Address</label>
                </div>
                <div class="relative mb-4">
                    <button type="submit" class="w-full bg-yellow-500 text-white rounded-md px-2 py-1">Send Reset Link.</button>
                </div>
            </form>

            <!-- Back to Login Link -->
            <p class="text-gray-600 text-sm mt-4">
                Remember your password? <a href="{{ route('LoginView') }}" class="text-yellow-500 hover:underline">Log In</a>
            </p>
        </div>
    </div>
</body>





</html>
