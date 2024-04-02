@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<body class="flex">    
    <div class="flex-1">
        <div class="container mx-auto p-8">
            <h1 class="text-2xl font-bold mb-4">Edit Blog Post</h1>
            <div class="grid grid-cols-4 gap-4">
                <!-- Columna de la barra lateral -->
                <div class="col-span-1">
                    <!-- Contenido de la barra lateral -->
                </div>
                <!-- Columna del formulario -->
                <div class="col-span-5">
                    <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                            <input type="text" id="title" name="title" value="{{ $blog->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                            <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $blog->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="post_image" class="block text-gray-700 font-bold mb-2">Image:</label>
                            <input type="file" id="post_image" name="post_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
</html>
