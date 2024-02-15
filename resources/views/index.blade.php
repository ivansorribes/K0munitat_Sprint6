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

<body class="bg-gray-100">

    <div class="container mx-auto px-4 mt-8">

        <h1 class="text-2xl font-bold mb-4">Listado de Comunidades</h1>

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activate / Desactivate</th>


                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($communities as $community)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $community->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $community->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $community->created_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">@if($community->isActive == 1)
                        Active
                        @else
                        Inactive
                        @endif

                        <form action="{{ route('stateChange', ['id' => $community->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Activate/Desactivate</button>
                        </form>

                    </td>



                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</body>

</html>