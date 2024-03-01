<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 - REACT 18</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body class="flex">
    <div id="sidebar-container"></div>

    <div class="flex-1">
        <div class="container mx-auto p-8">
            <h1 class="text-2xl font-bold mb-4">Listado de Usuarios de la Comunidad {{ $community->name }}</h1>
            <ul>
                @foreach($users as $user)
                <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</body>

</html>