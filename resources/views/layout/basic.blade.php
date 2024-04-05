<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mi Sitio')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!--Favicon-->
    <link rel="icon" href="{{ asset('img/k0munitat_imagotip.ico') }}" type="image/x-icon"/>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B54X46SNYZ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-B54X46SNYZ');
    </script>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>
<body>
    @include('header.header')

    <main class="mt-16 mb-16">
        @yield('content')
    </main>

    @include('footer.footer')
      <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
