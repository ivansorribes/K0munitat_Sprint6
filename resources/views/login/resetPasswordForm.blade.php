<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password Form</title>
    <link rel="icon" href="{{ asset('img/k0munitat_imagotip.ico') }}" type="image/x-icon"/>

    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-white">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full max-w-md text-center">
            <!-- Logo -->
            <img src="{{ asset('img/logo.png') }}" alt="K0munitat Logo" class="mx-auto mb-10" style="max-width: 250px;">

            <!-- Reset Password Content -->
            <div class="mb-8 text-gray-900">
                <p class="text-lg font-semibold mb-4">Reset Password</p>
                <p class="text-sm">Provide your new password to reset your account password.</p>
            </div>

            <!-- Reset Password Form -->
            <form method="POST" action="{{ route('reset.password')}}" class="mb-8">
                @if (Session::get('fail'))
                    <div class="alert alert-danger text-red-500">
                        {{ Session::get('fail') }}
                    </div>
                @endif

                @if (Session::get('success'))
                    <div class="alert alert-success text-green-500">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email Input -->
                <div class="mb-4 relative">
                    <input id="email" name="email" type="text"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Email address" value="{{ $email ?? old('email' )}}" />
                    <label for="email"
                        class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email
                        Address</label>
                </div>

                <!-- Password Input -->
                <div class="mb-4 relative">
                    <input id="password" name="password" type="password"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="New Password" value="{{ old('password') }}" />
                    <span class="text-red-500">@error('password'){{ $message }} @enderror</span>
                    <label for="password"
                        class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">New Password</label>
                </div>

                <!-- Password Confirmation Input -->
                <div class="mb-4 relative">
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Confirm Password" value="{{ old('password_confirmation') }}" />
                    <span class="text-red-500">@error('password_confirmation'){{ $message }} @enderror</span>
                    <label for="password_confirmation"
                        class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Confirm Password</label>
                </div>

                <!-- Submit Button -->
                <div class="relative mb-4">
                    <button type="submit" class="w-full bg-yellow-500 text-white rounded-md px-2 py-1">Reset Password</button>
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
