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

<body>

    <div class="container mx-auto px-4 mt-8">

        <h1 class="text-2xl font-bold mb-4">Listado de Posts</h1>

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Community</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creation Date</th>

                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($posts as $post)
                <tr>
                    <form id="editForm" action="{{ route('update.post',[$post->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if($post->type == 'post')
                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->community->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->user->username }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">


                            <input type="text" name="title" value="{{ $post->title }}">

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <textarea form="editForm" name="description">{{ $post->description }}</textarea>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->created_at }} <button type="submit">Guardar</button>
                        </td>

                    </form>
                    @else

                    @endif






                </tr>

                @endforeach
            </tbody>

        </table>

    </div>

</body>

</html>