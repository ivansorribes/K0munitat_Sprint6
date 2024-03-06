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
        <div class="container mx-auto p-8 pl-64">
            <h1 class="text-2xl font-bold mb-4 ml-4">Listado de Comunidades</h1>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">Community Admin</th>
                                        <th scope="col" class="px-6 py-4">Name</th>
                                        <th scope="col" class="px-6 py-4">Description</th>
                                        <th scope="col" class="px-6 py-4">User List</th>
                                        <th scope="col" class="px-6 py-4">Creation Date</th>
                                        <th scope="col" class="px-6 py-4">State</th>
                                        <th scope="col" class="px-6 py-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($communities as $community)
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4">{{ $community->admin->username }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $community->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $community->description }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <form action="{{ route('showUsers', $community->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm bg-info px-2 py-1 text-white rounded">
                                                    Users
                                                </button>
                                            </form>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $community->created_at }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            @if($community->isActive)
                                            <span class="text-green-500">Active &#10004;</span>
                                            @else
                                            <span class="text-red-500">Inactive &#10008;</span>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <form action="{{ route('stateChange', $community->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm {{ $community->isActive ? 'bg-red-500' : 'bg-green-500' }} text-white px-2 py-1 rounded">
                                                    {{ $community->isActive ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>


</html>