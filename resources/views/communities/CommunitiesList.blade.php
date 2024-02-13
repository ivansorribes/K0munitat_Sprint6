<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ًCommunities List</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @viteReactRefresh
        @vite('resources/js/app.js')
        @vite('resources/css/app.css')
    </head>
    <body >
        <button >Crear</button>
         <div id="communityList"></div>
    </body>
</html>