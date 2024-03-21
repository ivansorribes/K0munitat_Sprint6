<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<!-- otra_vista.blade.php -->
@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')

<body class="flex">    
    <div class="flex-1">
        <div class="container mx-auto p-8">
            <h1 class="text-2xl font-bold mb-4">Crear Publicacion En El Blog</h1>
<form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
        <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
        <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>
    <div class="mb-4">
        <label for="post_image" class="block text-gray-700 font-bold mb-2">Image:</label>
        <input type="file" id="post_image" name="post_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Blog</button>
</form>

</body>
@endsection

</html>