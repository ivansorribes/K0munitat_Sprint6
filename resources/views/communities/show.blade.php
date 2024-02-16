@extends('layout.basic')

@section('title', 'Community')

@section('content')
    <body>
        <h1>{{ $community->name }}</h1>
        <p>{{ $community->description }}</p>
        <div>
            <a href="{{ route('post-list', ['community' => $community->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block text-center">
                View Posts
            </a>
            <a href="{{ route('advertisement-list', ['community' => $community->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block text-center">
                View Advertisements
            </a>
        </div>
        <div>
            <a href="{{ route('form-create-post', ['community' => $community->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block text-center">
                Create Post
            </a>
            <a href="{{ route('form-create-advertisement', ['community' => $community->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-block text-center">
                Create Advertisement
            </a>
        </div>
    </body>
@endsection
