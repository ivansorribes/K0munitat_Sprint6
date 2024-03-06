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
            <h1 class="text-2xl font-bold mb-4 ml-4">Listado de Advertisements</h1>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">Community</th>
                                        <th scope="col" class="px-6 py-4">User</th>
                                        <th scope="col" class="px-6 py-4">Title</th>
                                        <th scope="col" class="px-6 py-4">Description</th>
                                        <th scope="col" class="px-6 py-4">Category</th>
                                        <th scope="col" class="px-6 py-4">State</th>
                                        <th scope="col" class="px-6 py-4">Change State</th>
                                        <th scope="col" class="px-6 py-4">Creation Date</th>
                                        <th scope="col" class="px-6 py-4">Save State</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $advertisement)
                                    @if($advertisement->type == 'advertisement')
                                    <tr class="border-b dark:border-neutral-500">
                                        <form id="editAdvertisementForm{{$advertisement->id}}" action="{{ route('update.advertisement', [$advertisement->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="type" value="advertisement">
                                            <td class="whitespace-nowrap px-6 py-4">{{ $advertisement->community->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $advertisement->user->username }}</td>
                                            <td class="whitespace-nowrap px-6 py-4"><input type="text" name="title" value="{{ $advertisement->title }}"></td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <textarea form="editAdvertisementForm{{$advertisement->id}}" name="description">{{ $advertisement->description }}</textarea>
                                            </td>
                                            <!-- <td class="whitespace-nowrap px-6 py-4">{{ $advertisement->id_category }}</td> arreglar per mostrar nom de la categoria -->
                                            <td class="whitespace-nowrap px-6 py-4">
                                                @if($advertisement->isActive)
                                                <span class="text-green-500">Active &#10004;</span>
                                                @else
                                                <span class="text-red-500">Inactive &#10008;</span>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4">

                                                <button type="submit" class="btn btn-sm {{ $advertisement->isActive ? 'bg-red-500' : 'bg-green-500' }} text-white px-2 py-1 rounded">
                                                    {{ $advertisement->isActive ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $advertisement->created_at }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <button class="btn btn-sm bg-green-500 text-white px-2 py-1 rounded" type="submit">Save</button>
                                            </td>
                                        </form>
                                    </tr>
                                    @endif
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