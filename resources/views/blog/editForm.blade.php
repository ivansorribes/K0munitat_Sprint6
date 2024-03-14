
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
            <h1 class="text-2xl font-bold mb-4">Crear Publicacion En El Blog</h1>
    <form method="GET" action="{{ route('blog.update', $blog->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="title" class="block name="description">Title:</label>
        <textarea id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description">{{ $blog->title }}</textarea>
    </div>
    <div class="mb-4">
        <label for="title" class="block name="description">Description:</label>
        <textarea id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description">{{ $blog->description }}</textarea>
    </div>
    <div class="mb-4">
        <label for="post_image" class="block text-gray-700 font-bold mb-2">Image:</label>
        <input type="file" id="post_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description">{{ $blog->post_image }}</textarea>
   </div>
    <button type="submit" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
</form>


</body>

</html>