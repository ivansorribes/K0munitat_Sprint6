<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<script src="{{ asset('js/adminpanel/blog/BlogAdminPanelValidations.js') }}"></script>

@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')

<style>
    .validation-error {
        font-size: 0.875rem; /* Tamaño del texto */
        color: #e53e3e; /* Color rojo */
        margin-top: 0.25rem; /* Espacio en la parte superior */
    }
</style>

<body class="flex">    
    <div class="flex-1">
        <div class="container mx-auto p-8">
            <h1 class="text-2xl font-bold mb-4">Create New Blog Post</h1>
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                    <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div id="title-error" class="validation-error"></div>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                    <textarea id="description" name="description" class="hidden"></textarea>
                    <div id="editor"></div>
                    <div id="description-error" class="validation-error"></div>
                </div>
                <div class="mb-4">
                    <label for="post_image" class="block text-gray-700 font-bold mb-2">Image:</label>
                    <input type="file" id="post_image" name="post_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div id="image-error" class="validation-error"></div>   
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    const data = editor.getData();
                    document.querySelector('#description').value = data;
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
@endsection

</html>