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
        <div class="container mx-auto p-8 mr-5">
            <h1 class="text-2xl font-bold mb-4">Listado de Advertisements</h1>
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200 px-4 py-2">Community</th>
                        <th class="border border-gray-200 px-4 py-2">User</th>
                        <th class="border border-gray-200 px-4 py-2">Title</th>
                        <th class="border border-gray-200 px-4 py-2">Description</th>
                        <th class="border border-gray-200 px-4 py-2">Category</th>
                        <th class="border border-gray-200 px-4 py-2">State</th>
                        <th class="border border-gray-200 px-4 py-2">Creation Date</th>
                        <th class="border border-gray-200 px-4 py-2">Save State</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $advertisement)
                    @if($advertisement->type == 'advertisement')
                    <tr>
                        <form id="editAdvertisementForm{{$advertisement->id}}" action="{{ route('update.advertisement', [$advertisement->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="type" value="advertisement">
                            <td class="border border-gray-200 px-4 py-2">{{ $advertisement->community->name }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $advertisement->user->username }}</td>
                            <td class="border border-gray-200 px-4 py-2"><input type="text" name="title" value="{{ $advertisement->title }}"></td>
                            <td class="border border-gray-200 px-4 py-2">
                                <textarea form="editAdvertisementForm{{$advertisement->id}}" name="description">{{ $advertisement->description }}</textarea>
                            </td>
                            <td class="border border-gray-200 px-4 py-2">{{ $advertisement->id_category }}</td>
                            <td class="border border-gray-200 px-4 py-2" style="white-space: nowrap;">
                                @if($advertisement->isActive)
                                <span style="color: green; display: inline-block; vertical-align: middle;">Active &#10004;</span>
                                @else
                                <span style="color: red; display: inline-block; vertical-align: middle;">Inactive &#10008;</span>
                                @endif
                            </td>
                            <td class="border border-gray-200 px-4 py-2">{{ $advertisement->created_at }}</td>
                            <td class="border border-gray-200 px-4 py-2">
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
</body>

</html>