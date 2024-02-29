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
            <h1 class="text-2xl font-bold mb-4">Listado de Comunidades</h1>
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200 px-4 py-2">Community Admin</th>
                        <th class="border border-gray-200 px-4 py-2">Nombre</th>
                        <th class="border border-gray-200 px-4 py-2">Descripción</th>
                        <th class="border border-gray-200 px-4 py-2">Data de creació</th>
                        <th class="border border-gray-200 px-4 py-2">Activo</th>
                        <th class="border border-gray-200 px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($communities as $community)
                    <tr>
                        <form action="{{ route('stateChange', $community->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td class="border border-gray-200 px-4 py-2">{{ $community->admin->username }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $community->name }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $community->description }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $community->created_at }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $community->isActive ? 'Activo' : 'Inactivo' }}</td>
                            <td class="border border-gray-200 px-4 py-2">

                                <button type="submit" class="btn btn-sm {{ $community->isActive ? 'bg-red-500' : 'bg-green-500' }} text-white px-2 py-1 rounded">
                                    {{ $community->isActive ? 'Desactivar' : 'Activar' }}
                                </button>
                            </td>
                        </form>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>