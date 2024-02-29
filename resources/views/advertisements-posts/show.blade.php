<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Advertisement Details</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@include('header.header')

<body>
    <input id="id_user" type="hidden" value="{{ Auth()->user()->id}}">
    <div id="advertisementDetails"></div>
    <div id="advertisementComments"></div>
</body>
@include('footer.footer')

</html>