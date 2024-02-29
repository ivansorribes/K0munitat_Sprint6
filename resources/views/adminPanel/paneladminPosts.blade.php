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
            <h1 class="text-2xl font-bold mb-4">Listado de Posts</h1>
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200 px-4 py-2">Community</th>
                        <th class="border border-gray-200 px-4 py-2">User</th>
                        <th class="border border-gray-200 px-4 py-2">Title</th>
                        <th class="border border-gray-200 px-4 py-2">Description</th>
                        <th class="border border-gray-200 px-4 py-2">Creation Date</th>
                        <th class="border border-gray-200 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <form id="editForm" action="{{ route('update.post',[$post->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if($post->type == 'post')
                            <td class="border border-gray-200 px-4 py-2">{{ $post->community->name }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $post->user->username }}</td>
                            <td class="border border-gray-200 px-4 py-2"><input type="text" name="title" value="{{ $post->title }}"></td>
                            <td class="border border-gray-200 px-4 py-2">
                                <textarea form="editForm" name="description">{{ $post->description }}</textarea>
                            </td>
                            <td class="border border-gray-200 px-4 py-2">{{ $post->created_at }}</td>
                            <td class="border border-gray-200 px-4 py-2">
                                <button class="btn btn-sm bg-green-500 text-white px-2 py-1 rounded" type="submit">Save</button>
                            </td>
                        </form>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>