@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<script src="{{ asset('js/adminpanel/blog/BlogAdminPanelValidations.js') }}"></script>
<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {   
                    console.error(error);
                });
        });
    </script>
    <style>
        .validation-error {
            font-size: 0.875rem; /* Tamaño del texto */
            color: #e53e3e; /* Color rojo */
            margin-top: 0.25rem; /* Espacio en la parte superior */
        }
    </style>
</head>
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
                    <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                        @csrf
                        @method('PATCH')                    
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                            <input type="text" id="title" name="title" value="{{ $blog->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <div id="title-error" class="validation-error"></div>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                            <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $blog->description }}</textarea>
                            <div id="description-error" class="validation-error"></div>
                        </div>
                        <div class="mb-4">
                            <label for="post_image" class="block text-gray-700 font-bold mb-2">Image:</label>
                            <input type="file" id="post_image" name="post_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <div id="image-error" class="validation-error"></div>
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
