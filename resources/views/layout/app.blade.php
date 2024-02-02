<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ... otras etiquetas head ... -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Incluye el encabezado en todas las páginas -->
    @include('header')

    <!-- Contenido de la página -->
    <div class="container mx-auto my-4">
        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
