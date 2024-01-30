<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

</head>

<body class="min-h-screen flex items-center justify-center bg-white">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full max-w-md text-center">
            <h2 class="text-2xl font-semibold mb-6 text-center text-yellow-600">Registro</h2>
            <form action="{{ route('validate-register') }}" method="post" class="grid grid-cols-2 gap-4">
                @csrf
                <div class="mb-4 relative">
                    <label for="firstname" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Nombre
                    </label>
                    <input
                        type="text"
                        id="firstname"
                        name="firstname"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Nombre"
                        required
                    />
                </div>
                <div class="mb-4 relative">
                    <label for="lastname" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Apellido
                    </label>
                    <input
                        type="text"
                        id="lastname"
                        name="lastname"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Apellido"
                        required
                    />
                </div>
                <div class="mb-4 relative">
                    <label for="username" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Nombre de Usuario
                    </label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Nombre de Usuario"
                        required
                    />
                </div>
                <div class="mb-4 relative">
                    <label for="email" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Correo Electrónico
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="correo@example.com"
                        required
                    />
                </div>
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Contraseña
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="********"
                        required
                    />
                </div>
                <div class="mb-4 relative">
                    <label for="city" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Ciudad
                    </label>
                    <input
                        type="text"
                        id="city"
                        name="city"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Ciudad"
                        required
                    />
                </div>
                <div class="mb-4 relative">
                    <label for="postcode" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Código Postal
                    </label>
                    <input
                        type="text"
                        id="postcode"
                        name="postcode"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Código Postal"
                        required
                    />
                </div>
                <div class="mb-4 relative">
                    <label for="telephone" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Teléfono
                    </label>
                    <input
                        type="text"
                        id="telephone"
                        name="telephone"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Teléfono"
                        required
                    />
                </div>
                <div class="mb-4 relative">
                    <label for="profile_description" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Descripción del Perfil
                    </label>
                    <input
                        type="text"
                        id="profile_description"
                        name="profile_description"
                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600"
                        placeholder="Descripción del Perfil"
                        required
                    />
                </div>
                <button
                    type="submit"
                    class="col-span-2 w-full bg-yellow-500 text-white p-3 rounded hover:bg-yellow-600 transition duration-300 mb-4"
                >
                    Registrar
                </button>
            </form>
        </div>
    </div>
</body>


</html>