<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/k0munitat_imagotip.ico') }}" type="image/x-icon" />
    <title>About Us</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body>
    @include('header.header')
    <div id="preloader" style="position: fixed; top: 80px; width: 100%; height: calc(100% - 50px); background: white; z-index: 1000;">
        @include('components.spinner')
    </div>
    <script>
        window.onload = function() {
            document.getElementById('preloader').style.display = 'none';
        };
    </script>
    <div class="mx-20 my-10" id="aboutus"></div>
</body>
@include('footer.footer')

</html>