<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact</title>
    @viteReactRefresh      
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    @include('header.header')
</head>
<body>
<div id="Contact"></div>
<script>
    window.csrf_token = "{{ csrf_token() }}";
</script>
@include('footer.footer')
</body>
</html>
