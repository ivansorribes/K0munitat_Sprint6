<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body>
    <!--Header para un usuario no autenticado-->
    <header class="bg-[#fffdf9]  px-6  shadow">
        <div class="flex h-30 max-w-6xl mx-auto items-center justify-between">
            <button class="text-[#adce71] rounded p-1 -ml-1 transition-colors hover:bg-[#f4971e] hover:text-[#fffdf9] focus:ring-2">
                <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-8 w-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
            </button>
            <!--<a href="#">LOgo</a>-->
            <div class="flex cursor-pointer -mr-4 ml-8">
                <a href="{{ route('LoginView') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Komunitat" class="hover:scale-110 h-10 mt-2">
                </a>
                <div class="space-y-1 space-x-8 ml-8 pb-3 border-t pt-2 hidden md:flex">
                    <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-[#fffdf9] w-full md:w-auto md:py-0 py-4 md:pl-0 pl-7 left-0">
                        <li class="mx-4 my-6 md:my-0">
                            <a href="#" class="block px-3 py-2 text-[#f4971e] rounded-md">Home</a>
                        </li>
                        <li class="mx-4 my-6 md:my-0">
                            <a href="#" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500">Blog</a>
                        </li>
                        <li class="mx-4 my-6 md:my-0">
                            <a href="{{ route('about-us') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500">About Us</a>
                        </li>
                        <div class="lg:flex items-center gap-6 space-x-4 md:flex items-center md:z-auto md:static absolute w-auto ml-8">
                            <a href="{{ route('LoginView') }}" class="bg-[#155b2a] text-[#fffdf9] px-5 py-2 btn-action rounded-full hover:bg-[#f4971e] transition duration-300">Login</a>
                            <a href="{{ route('RegisterView') }}" class="bg-gradient-to-br from-[#155b2a] to-[#adce71] text-[#fffdf9] px-5 py-2 btn-action rounded-full hover:bg-[#f4971e] transition duration-300">Sign up</a>
                        </div>
                    </ul>
                </div>

            </div>
            <div>
                <button>
                    <svg class="h-8 w-8 text-[#adce71] rounded-full transition-colors hover:bg-[#f4971e] hover:text-[#fffdf9] focus:ring-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"></path>
                    </svg>
                </button>
            </div>
        </div>
        <nav class="md:flex md:items-center md:justify-between">

            <!-- Menú de pantalla de navegación -->
            <div class="space-y-1 pb-3 border-t pt-2 md:hidden ">
                <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-[#fffdf9] w-full md:w-auto md:py-0 py-4 md:pl-0 pl-7 left-0">
                    <li class="mx-4 my-6 md:my-0">
                        <a href="#" class="block px-3 py-2 text-[#fffdf9] bg-[#f4971e] rounded-md">Home</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="#" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#fffdf9] hover:bg-[#f4971e] rounded-md duration-500">Communities</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="#" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#fffdf9] hover:bg-[#f4971e] rounded-md duration-500">Blog</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('about-us') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#fffdf9] hover:bg-[#f4971e] rounded-md duration-500">About Us</a>
                    </li>
                </ul>
            </div>

            <!-- Botones de navegación -->
            <div class="md:hidden sm:flex items-end gap-6 space-x-4 sm:z-auto sm:static absolute w-auto">
                <a href="{{ route('validate-register') }}" class="bg-[#155b2a] text-[#fffdf9] px-5 py-2 btn-action rounded-full hover:bg-[#f4971e] transition duration-300">Login</a>
                <a href="{{ route('LoginView') }}" class="bg-gradient-to-br from-[#155b2a] to-[#adce71] text-[#fffdf9] px-5 py-2 btn-action rounded-full hover:bg-[#f4971e] transition duration-300">Sign up</a>
            </div>

        </nav>
    </header>

    <!--Header para usuarios autenticados-->
    <header class="bg-[#fffdf9] px-6 shadow hidden" id="authHeader">
        <div class="flex h-16 max-w-6xl mx-auto items-center justify-between">
            <button class="text-[#adce71] rounded p-1 -ml-1 transition-colors hover:bg-[#f4971e] hover:text-[#fffdf9] focus:ring-2">
                <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-8 w-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
            </button>
            <div class="flex cursor-pointer -mr-4 ml-8">
                <a href="{{ route('inicia-sesion') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Komunitat" class="hover:scale-110 h-10 mt-2">
                </a>
                <div class="space-y-1 space-x-8 ml-8 pb-3 border-t pt-2 hidden md:flex">
                    <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-[#fffdf9] w-full md:w-auto md:py-0 py-4 md:pl-0 pl-7 left-0">
                        <li class="mx-4 my-6 md:my-0">
                            <a href="#" class="block px-3 py-2 text-[#f4971e] rounded-md">Home</a>
                        </li>
                        <li class="mx-4 my-6 md:my-0">
                            <a href="#" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500">Communities</a>
                        </li>
                        <li class="mx-4 my-6 md:my-0">
                            <a href="#" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500">Blog</a>
                        </li>
                        <li class="mx-4 my-6 md:my-0">
                            <a href="{{ route('about-us') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500">About Us</a>
                        </li>
                        <div class="lg:flex items-center gap-6 space-x-4 md:flex items-center md:z-auto md:static absolute w-auto ml-8">
                            <a href="{{ route('LoginView') }}" class="bg-[#155b2a] text-[#fffdf9] px-5 py-2 btn-action rounded-full hover:bg-[#f4971e] transition duration-300">Login</a>
                            <a href="{{ route('RegisterView') }}" class="bg-gradient-to-br from-[#155b2a] to-[#adce71] text-[#fffdf9] px-5 py-2 btn-action rounded-full hover:bg-[#f4971e] transition duration-300">Sign up</a>
                        </div>
                    </ul>
                </div>

            </div>
            <div>
                <button>
                    <svg class="h-8 w-8 text-[#adce71] rounded-full transition-colors hover:bg-[#f4971e] hover:text-[#fffdf9] focus:ring-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"></path>
                    </svg>
                </button>
            </div>
        </div>
        <nav class="md:flex md:items-center md:justify-between">

            <!-- Menú de pantalla de navegación -->
            <div class="space-y-1 pb-3 border-t pt-2 md:hidden ">
                <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-[#fffdf9] w-full md:w-auto md:py-0 py-4 md:pl-0 pl-7 left-0">
                    <li class="mx-4 my-6 md:my-0">
                        <a href="#" class="block px-3 py-2 text-[#fffdf9] bg-[#f4971e] rounded-md">Home</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="#" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#fffdf9] hover:bg-[#f4971e] rounded-md duration-500">Communities</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="#" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#fffdf9] hover:bg-[#f4971e] rounded-md duration-500">Blog</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('about-us') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#fffdf9] hover:bg-[#f4971e] rounded-md duration-500">About Us</a>
                    </li>
                </ul>
            </div>

    

        </nav>
    </header>

<!-- JavaScript para controlar la visualización de los headers -->
<script>
    // Supongamos que 'isLoggedIn' es una variable que indica si el usuario ha iniciado sesión o no
    const isLoggedIn = true; // Cambiar a false si el usuario no ha iniciado sesión
    
    // Obtener referencias a los headers
    const nonAuthHeader = document.querySelector('.non-auth-header');
    const authHeader = document.querySelector('.auth-header');
    
    // Mostrar el header correcto según el estado de autenticación
    if (isLoggedIn) {
        nonAuthHeader.style.display = 'none'; // Ocultar header para usuarios no autenticados
        authHeader.style.display = 'block'; // Mostrar header para usuarios autenticados
    } else {
        nonAuthHeader.style.display = 'block'; // Mostrar header para usuarios no autenticados
        authHeader.style.display = 'none'; // Ocultar header para usuarios autenticados
    }
</script>

</body>

</html>