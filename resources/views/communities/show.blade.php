<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ًCommunities Edit</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @viteReactRefresh
        @vite('resources/js/app.js')
        @vite('resources/css/app.css')
    </head>
    <body >
    <script>
        function handleEditClick(community) {
            // Implementa tu lógica para manejar el evento de clic en "Editar"
            console.log('Editar clickeado para la comunidad:', community);
            // Puedes redirigir a la página de edición o realizar cualquier otra acción aquí
        }
    </script>
        <div id="communityShow"></div>
        
    </body>
</html>