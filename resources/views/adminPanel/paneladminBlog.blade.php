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
            <h1 class="text-2xl font-bold mb-4">Listado de Publicaciones En El Blog</h1>
            <div class="flex mb-4 justify-end">
                <a href="{{ route('blog.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create Blog Post</a>
            </div>
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200 px-4 py-2">Title</th>
                        <th class="border border-gray-200 px-4 py-2">Description</th>
                        <th class="border border-gray-200 px-4 py-2">Post Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                    <tr>
                            @csrf
                            @method('PUT')
                            <td class="border border-gray-200 px-4 py-2">{{ $blog->title }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $blog->description }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $blog->post_image }}</td>
                            </td>
                            <td class="border border-gray-200 px-4 py-2">
                            <form method="GET" action="{{ route('blog.edit', $blog->id) }}">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                            </form>
                            <td class="border border-gray-200 px-4 py-2">
                            <form method="POST" action="{{ route('blog.destroy', $blog->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Borrar</button>
                            </form>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection


</html>

