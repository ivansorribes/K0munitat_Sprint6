<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 - REACT 18</title>
    @viteReactRefresh      
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    @include('header.header')
</head>
<body>
<div id="personalProfile"></div>
<script>
    window.csrf_token = "{{ csrf_token() }}";
</script>

</body>
@include('footer.footer')
</html>
