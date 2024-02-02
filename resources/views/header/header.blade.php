<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ًApplication</title>
        @viteReactRefresh
        @vite('resources/js/app.js')
        @vite('resources/css/app.css')
        <style>
            .sticky-nav {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1000;
                border-bottom: 2px solid #3d3c3b;
                background-color: #ffffff;
            }
               /* Estilos para el menú de navegación en dispositivos móviles */
            #mobileMenu {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background-color: #adce71; /* Color de fondo para el menú en dispositivos móviles */
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                z-index: 999; /* Asegura que el menú esté encima del contenido principal */
            }

            #mobileMenu ul {
                list-style: none;
                padding: 0;
                margin: 0;
                text-align: center;
            }

            #mobileMenu ul li {
                margin-bottom: 1rem;
            }
        </style>
    </head>
    <body>
        <nav class="bg-adce71 p-4 transition-all duration-300">
            <div class="container mx-auto flex items-center justify-between">
                <!-- Logo o imagen a la izquierda -->
                <img src="{{ asset('img/Logo_K0munitat-removebg-preview.png') }}" alt="Logo" class="h-10">

                <!-- Menú de navegación -->
                <ul class="hidden lg:flex items-center space-x-4">
                    <li><a href="#" class="text-3d3c3b">Home</a></li>
                    <li><a href="#" class="text-3d3c3b">Communities</a></li>
                    <li><a href="#" class="text-3d3c3b">Blog</a></li>
                    <li><a href="{{ route('about-us') }}" class="text-3d3c3b">About Us</a></li>
                </ul>
        
                <!-- Botones de navegación para pantallas grandes -->
                <div class="hidden lg:flex space-x-4">
                    <a href="{{ route('inicia-sesion') }}" class="text-3d3c3b hover:text-gray-300">Sign up</a>
                    <a href="{{ route('validate-register') }}" class="text-3d3c3b hover:text-gray-300">Login</a>
                </div>

                <!-- Menú de hamburguesa para pantallas pequeñas -->
                <div id="mobileMenu" class="lg:hidden hidden">
                    <button id="menuToggle" class="text-3d3c3b focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Menú de navegación para pantallas pequeñas (inicialmente oculto) -->
                <div id="mobileMenu" class="lg:hidden hidden">
                    <ul class="flex flex-col items-center space-y-4">
                        <li><a href="#" class="text-3d3c3b">Home</a></li>
                        <li><a href="#" class="text-3d3c3b">Communities</a></li>
                        <li><a href="#" class="text-3d3c3b">Blog</a></li>
                        <li><a href="{{ route('about-us') }}" class="text-3d3c3b">About Us</a></li>
                        <li><a href="{{ route('inicia-sesion') }}" class="text-3d3c3b hover:text-gray-300">Sign up</a></li>
                        <li><a href="{{ route('validate-register') }}" class="text-3d3c3b hover:text-gray-300">Login</a></li>
                    </ul>
                </div>

            </div>
        </nav>
        <script>
             // JavaScript para agregar/quitar la clase "sticky-nav" al hacer scroll
            window.addEventListener('scroll', function () {
                const navbar = document.querySelector('nav');
                navbar.classList.toggle('sticky-nav', window.scrollY > 0);
            });
            // JavaScript para mostrar/ocultar el menú de hamburguesa
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
        
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
            // JavaScript para mostrar/ocultar el menú de navegación en dispositivos móviles
            document.getElementById('menuToggle').addEventListener('click', function () {
                const mobileMenu = document.getElementById('mobileMenu');
                mobileMenu.classList.toggle('hidden', !mobileMenu.classList.contains('hidden'));
            });
        </script>
        
    </body>
</html>
