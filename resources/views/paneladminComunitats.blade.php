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

<body class="bg-blue-500">

    <div class="container">
        <h1>Listado de Comunidades</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($communities as $community)
                <tr>
                    <td>{{ $community->name }}</td>
                    <td>{{ $community->description }}</td>
                    <td>{{ $community->isActive ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        <form action="{{ route('stateChange', $community->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm {{ $community->isActive ? 'btn-danger' : 'btn-success' }}">
                                {{ $community->isActive ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>