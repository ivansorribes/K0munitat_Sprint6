<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Otras etiquetas head ... -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 - REACT 18</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
@include('header.header')



<body class="justify-center items-center" style="background-image: url('{{ asset('img/wallpaper-home.webp') }}'); background-size: cover; background-position: center;">


    <!-- Otras partes del cuerpo ... -->

    <!-- Decorative background image and gradient -->
    <div aria-hidden="true" class="absolute inset-0 w-full" style="z-index: -1;">
        <div class="absolute inset-0 mx-auto max-w-7xl overflow-hidden xl:px-8">
            <img src="https://static.vecteezy.com/system/resources/previews/027/100/937/non_2x/on-the-right-side-there-are-lying-vegetables-while-on-the-left-side-empty-space-to-copy-free-photo.jpg" alt="" class="h-50 w-full object-cover object-center">
        </div>
        <div class="absolute inset-0 bg-white bg-opacity-75"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-white via-white"></div>

    </div>

    <!-- Callout -->
    <section aria-labelledby="sale-heading" class="relative mx-auto flex max-w-7xl flex-col items-center px-4 pt-32 text-center sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-none">
            <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">Explore our wide variety of communities</h2>
            <p class="mx-auto mt-4 max-w-xl text-xl text-gray-600">Join a community to interact with its users and exchange products and tools</p>
            <a href="#" class="mt-6 inline-block w-full rounded-md border border-transparent bg-gray-900 px-8 py-3 font-medium text-white hover:bg-cyan-800 sm:w-auto">join a community
            </a>

        </div>
    </section>
    <div class="flex justify-center mt-10">
        <div id="map"></div>
    </div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 lg:py-10">
        <div id="exchanges"></div>
    </div>

</body>
@include('footer.footer')

</html>