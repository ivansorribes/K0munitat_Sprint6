<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

</head>

<body class="min-h-screen flex items-center justify-center bg-green-500">
    <h1>Pagina privada</h1>
    <div>
        <a href="{{ route('logout') }}"><button type="button" class="btn btn-outline-primary me-2">Salir</button></a>
    </div>
</body>

</html>