<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <style>
        .eye-icon {
            cursor: pointer;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-white">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full max-w-md text-center">
            <h2 class="text-2xl font-semibold mb-6 text-center text-yellow-600">Register</h2>
            <form action="{{ route('validate-register') }}" method="post">
                @csrf
            
                <div class="mb-4 relative">
                    <label for="firstname" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Name
                    </label>
                    <input
                        type="text"
                        id="firstname"
                        name="firstname"
                        value="{{ old('firstname') }}"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Nombre"
                    />
                    @error('firstname')
                        <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-4 relative">
                    <label for="lastname" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Surnames
                    </label>
                    <input
                        type="text"
                        id="lastname"
                        name="lastname"
                        value="{{ old('lastname') }}"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Apellido"
                    />
                    @error('lastname')
                        <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-4 relative">
                    <label for="username" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        User name
                    </label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Nombre de Usuario"
                    />
                    @error('username')
                        <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-4 relative">
                    <label for="email" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="correo@example.com"
                    />
                    @error('email')
                        <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 eye-icon" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </div>
                    </div>
                    @error('password')
                        <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-4 relative">
                    <label for="password_confirm" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirm"
                            name="password_confirm"
                            class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 eye-icon" id="togglePasswordConfirm">
                            <i class="far fa-eye"></i>
                        </div>
                    </div>
                    @error('password_confirm')
                        <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            
                <button
                    type="submit"
                    class="w-full bg-yellow-500 text-white p-3 rounded hover:bg-yellow-600 transition duration-300 mb-4"
                >
                    Submit
                </button>
            </form>
            
            
            <p class="text-gray-600 text-sm mt-4">
                Already have an account? <a href="{{ route('LoginView') }}" class="text-yellow-500 hover:underline">Log in</a>
            </p>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            if (type === 'password') {
                togglePassword.innerHTML = '<i class="far fa-eye"></i>';
            } else {
                togglePassword.innerHTML = '<i class="far fa-eye-slash"></i>';
            }
        });

        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirm = document.getElementById('password_confirm');

        togglePasswordConfirm.addEventListener('click', function () {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            if (type === 'password') {
                togglePasswordConfirm.innerHTML = '<i class="far fa-eye"></i>';
            } else {
                togglePasswordConfirm.innerHTML = '<i class="far fa-eye-slash"></i>';
            }
        });
    </script>
</body>

</html>
