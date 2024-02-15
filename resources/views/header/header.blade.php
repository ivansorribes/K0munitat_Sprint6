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
            <div class="flex cursor-pointer -mr-4 ml-8">
                <!--Logo-->
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Komunitat" class="hover:scale-110 h-10 mt-2">
                </a>
                <!--Menu de Navegacion-->
                <div class="space-y-1 space-x-8 ml-8 pb-3 border-t pt-2 hidden md:flex">
                    <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-[#fffdf9] w-full md:w-auto md:py-0 py-4 md:pl-0 pl-7 left-0">
                        <li class="mx-4 my-6 md:my-0">
                            <a href="{{ route('home') }}" class="block px-3 py-2 text-[#f4971e] rounded-md">Home</a>
                        </li>
                        <li class="mx-4 my-6 md:my-0">
                            <a href="{{ route('about-us') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500">Blog</a>
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
                <button id="hamburger-button" class="text-3xl md:hidden coursor-pointer">
                    &#9776;
                </button>
            </div>
        </div>
        

        <section id="mobile-menu" style="z-index:10;"class=" absolute top-0 bg-black w-full text-5xl flex-col justify-contnt-center origin-top animate-open-menu hidden">
            <button class="text-8xl self-end px-6">
                &times;
            </button>
            <nav class="flex flex-col min-h-screen items-center py-8 aria-label='mobile'">
                <a href="{{ route('home') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Home</a>
                <a href="{{ route('about-us') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Blog</a>
                <a href="{{ route('about-us') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">About Us</a>
                <a href="{{ route('LoginView') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Login</a>
            </nav>
        </section>

    </header>

   

    <script>
        const initApp = () =>{
            const hamburgerBtn = document.getElementById('hamburger-button')
            
            const mobileMenu = document.getElementById('mobile-menu')

            const toggleMenu = () => {
                mobileMenu.classList.toggle('hidden')
                mobileMenu.classList.toggle('flex')

            }

            hamburgerBtn.addEventListener('click', toggleMenu)
            mobileMenu.addEventListener('click', toggleMenu)
 
 
        }

        document.addEventListener('DOMContentLoaded', initApp)
    </script>
    
    
</body>

</html>


<!-- video https://youtu.be/0TxMHYCMALE?feature=shared-->