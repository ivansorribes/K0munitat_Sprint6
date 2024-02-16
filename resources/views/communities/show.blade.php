@extends('layout.basic')

@section('title', 'Community')

@section('content')
    <div class="text-center my-8">
        <h1 class="text-3xl font-bold">{{ $community->name }}</h1>
        <p class="text-gray-700">{{ $community->description }}</p>
    </div>

    <div class="flex justify-center space-x-4 my-4">
        <a href="{{ route('post-list', ['community' => $community->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block">
            View Posts
        </a>
        <a href="{{ route('advertisement-list', ['community' => $community->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block">
            View Advertisements
        </a>
    </div>

    <div class="flex justify-center space-x-4 my-4">
        <a href="{{ route('form-create-post', ['community' => $community->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block">
            Create Post
        </a>
        <a href="{{ route('form-create-advertisement', ['community' => $community->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block">
            Create Advertisement
        </a>
    </div>
@endsection
