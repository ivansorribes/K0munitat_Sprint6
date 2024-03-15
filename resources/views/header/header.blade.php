
@if(Auth::check())
<!--Header para un usuario Autenticado-->
<header class="bg-[#fffdf9]  px-6  shadow fixed top-0 z-50 w-full">
    <div class="flex h-20 max-w-6xl mx-auto items-center justify-between">
        <!--Logo-->
        <div>
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/K0munitat_Logo.svg') }}" alt="Logo Komunitat" class="hover:scale-110 h-10 w-auto">
            </a>
        </div>
        <!--Menu de Navegacion-->
        <div class="flex-grow flex justify-center">
            <div class="space-y-1 space-x-8 ml-8 pb-3  pt-2 hidden md:flex relative">
                <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-[#fffdf9] w-full md:w-auto md:py-0 py-4 md:pl-0 pl-7 left-0">
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('home') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('home') ? 'text-[#f4971e]' : '' }}">Home</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('blog') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('blog') ? 'text-[#f4971e]' : '' }}">Blog</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('calendar') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('calendar') ? 'text-[#f4971e]' : '' }}">Events</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('communities.index') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('communities.index') ? 'text-[#f4971e]' : '' }}">Communities</a>
                    </li>
                    <li class="mx-4 my-6 md:my-0">
                        <a href="{{ route('about-us') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('about-us') ? 'text-[#f4971e]' : '' }}">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex items-center ml-auto">
            <div class="relative">
                @if(Auth::user()->profile_image)
                    <img id="userIcon" src="{{ asset('profile/images/' . Auth::user()->profile_image) }}" alt="Profile Image" class="h-10 w-10 rounded-full">
                @else
                    <svg id="userIconDefault" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#155b2a] fill-current cursor-pointer" viewBox="0 0 20 20">
                        <path d="M10 0a6.671 6.671 0 00-6.667 6.667c0 3.817 3.115 6.667 6.667 6.667S16.667 10.484 16.667 6.667A6.671 6.671 0 0010 0zm0 10a3.333 3.333 0 010-6.667A3.333 3.333 0 0110 10zm7.887 7.887c-1.666-2.5-4.167-4.167-7.887-4.167s-6.221 1.666-7.887 4.167c-.276.415-.413.888-.413 1.416 0 .553.207 1.035.62 1.448.414.414.896.62 1.448.62.476 0 .96-.207 1.448-.62 1.084-1.084 2.5-1.667 4.246-1.667 1.747 0 3.163.583 4.246 1.667.487.414.972.62 1.448.62.476 0 .96-.207 1.448-.62.414-.414.62-.896.62-1.448 0-.528-.138-1.001-.413-1.416z" />
                    </svg>
                @endif
                <!-- Menú desplegable Dependiendo de si es Admin -->
                @if(Auth::check() && Auth::user()->role === 'superAdmin')
                    <div id="user-menu" style="z-index: 30" class="hidden absolute top-full right-0 mt-2 bg-white border rounded-md shadow-lg w-48">
                        <a href="{{ route('AdminPanel') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Admin Panel</a>
                        <a href="{{ route('ProfileView') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Log out</a>
                    </div>
                @else
                    <!-- Menú desplegable Dependiendo de no es Admin -->
                    <div id="user-menu" style="z-index: 30" class="hidden absolute top-full right-0 mt-2 bg-white border rounded-md shadow-lg">
                        <a href="{{ route('ProfileView') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Log out</a>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <button id="hamburger-button" class="text-3xl md:hidden coursor-pointer">
                &#9776;
            </button>
        </div>
    </div>


    <section id="mobile-menu" style="z-index:10;" class=" absolute top-0 bg-black w-full text-5xl flex-col justify-contnt-center origin-top animate-open-menu hidden">
        <button class="text-8xl self-end px-6 text-[#fffdf9]">
            &times;
        </button>
        <nav class="flex flex-col min-h-screen items-center py-8 aria-label='mobile'">
            <a href="{{ route('home') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Home</a>
            <a href="{{ route('blog') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Blog</a>
            <a href="{{ route('communities.index') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Community</a>
            <a href="{{ route('about-us') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">About Us</a>
            <a href="{{ route('logout') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Log out</a>
        </nav>
    </section>

</header>
@else
<!--Header para un usuario no autenticado-->
<header class="bg-[#fffdf9]  px-6  shadow fixed top-0 z-50 w-full">
    <div class="flex h-20 max-w-6xl mx-auto items-center justify-between">
        <div class="flex cursor-pointer -mr-4 ml-8">
            <!--Logo-->
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/K0munitat_Logo.svg') }}" alt="Logo Komunitat" class="hover:scale-110 h-10">
            </a>
           
           
        </div>
         <!--Menu de Navegacion-->
         <div class="space-y-1 space-x-8 ml-8 pb-3 pt-2 hidden md:flex">
            <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-[#fffdf9] w-full md:w-auto md:py-0 py-4 md:pl-0 pl-7 left-0">
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('home') ? 'text-[#f4971e]' : '' }}">Home</a>
                </li>
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('blog') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('blog') ? 'text-[#f4971e]' : '' }}">Blog</a>
                </li>
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('calendar') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('calendar') ? 'text-[#f4971e]' : '' }}">Events</a>
                </li>
                <li class="mx-4 my-6 md:my-0">
                    <a href="{{ route('about-us') }}" class="block px-3 py-2 text-[#3d3c3b] transition-colors hover:text-[#f4971e] duration-500 {{ request()->routeIs('about-us') ? 'text-[#f4971e]' : '' }}">About Us</a>
                </li>
               
            </ul>
        </div>
        <div class=" hidden lg:flex items-center gap-6 space-x-4 md:flex items-center md:z-auto md:static absolute w-auto ml-8">
            <a href="{{ route('LoginView') }}" class="bg-[#155b2a] text-[#fffdf9] px-5 py-2 btn-action rounded-full hover:bg-[#f4971e] transition duration-300">Login</a>
            <a href="{{ route('RegisterView') }}" class="bg-gradient-to-br from-[#155b2a] to-[#adce71] text-[#fffdf9] px-5 py-2 btn-action rounded-full hover:bg-[#f4971e] transition duration-300">Sign up</a>
        </div>
        <div>
            <button id="hamburger-button" class="text-3xl md:hidden coursor-pointer">
                &#9776;
            </button>
        </div>
    </div>


    <section id="mobile-menu" style="z-index:10;" class=" absolute top-0 bg-black w-full text-5xl flex-col justify-contnt-center origin-top animate-open-menu hidden">
        <button class="text-8xl self-end px-6 text-[#fffdf9]">
            &times;
        </button>
        <nav class="flex flex-col min-h-screen items-center py-8 aria-label='mobile'">
            <a href="{{ route('home') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Home</a>
            <a href="{{ route('blog') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Blog</a>
            <a href="{{ route('about-us') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">About Us</a>
            <a href="{{ route('LoginView') }}" class="w-full text-center py-6 text-[#fffdf9] hover:opacity-90">Login</a>
        </nav>
    </section>

</header>
@endif

<script>
    const initApp = () => {
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
    var userIcon = document.getElementById('userIcon');
    var userIconDefault = document.getElementById('userIconDefault');
    var userMenu = document.getElementById('user-menu');

    if(userIcon){
        userIcon.addEventListener('click', function() {
            userMenu.classList.toggle('hidden');
        });
    }
   
    if(userIconDefault){
        userIcon.addEventListener('click', function() {
            userMenu.classList.toggle('hidden');
        });
    }
</script>


