<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">

<!-- postDetails.blade.php -->
@extends('adminPanel.layout')

@section('title', 'Post Details')

@section('content')

<form action="{{ route('update.post', ['post' => $post]) }}" method="POST">
    @csrf
    @method('PUT') <!-- Método HTTP para la actualización -->

    <div class="container mx-auto px-4 py-8">
        <h1 class="mt-16 text-2xl mb-4">
            Edit Post
        </h1>
        <!-- Display validation errors -->



        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @if ($errors->any())
            <div class="alert bg-red-200">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Display success message -->
            @if (session('success'))
            <div class="alert bg-green-400">
                {{ session('success') }}
            </div>
            @endif

            <div class="flex flex-wrap -mx-2 mt-5">
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Title" value="{{ $post->title }}">
                </div>
                <div class="w-full md:w-2/3 px-2 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <!-- Aumenta la altura del textarea con el estilo CSS -->
                    <textarea style="height: 100px;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Description">{{ $post->description }}</textarea>
                </div>

                <div class="px-2 mb-4 md:w-1/3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                        Category
                    </label>
                    <input readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" name="category" type="text" placeholder="Category" value="{{ $post->category->name }}">
                </div>
                <div class="px-2 mb-4 md:w-1/3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="created_at">
                        Created at
                    </label>
                    <input readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="created_at" name="created_at" type="text" placeholder="Created at" value="{{ $post->created_at }}">
                </div>
                <div class="px-2 mb-4 md:w-1/3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="updated_at">
                        Updated at
                    </label>
                    <input readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="updated_at" name="updated_at" type="text" placeholder="Updated at" value="{{ $post->updated_at }}">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button class="btn btn-sm px-2 py-1 text-white bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit">
                    Save
                </button>
            </div>
        </div>
    </div>
</form>


@endsection