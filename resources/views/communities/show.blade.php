@extends('layout.basic')

@section('title', 'Community')

@section('content')
    <link rel="stylesheet" type="text/css" href="../../css/communities.css" />
    <div class="flex items-center justify-center my-40">
        <div class="m-4">
            <div class="text-center my-8">
                <h1 class="text-3xl font-bold">{{ $community->name }}</h1>
                <p class="text-gray-700">{{ $community->description }}</p>
            </div>

            <div class="flex flex-wrap justify-center my-4">
                <a href="{{ route('post-list', ['community' => $community->id]) }}" class="button-card view-button">
                    View Posts
                </a>
                <a href="{{ route('advertisement-list', ['community' => $community->id]) }}" class="button-card view-button">
                    View Advertisements
                </a>
                <a href="{{ route('form-create-post', ['community' => $community->id]) }}" class="button-card view-button">
                    Create Post
                </a>
                <a href="{{ route('form-create-advertisement', ['community' => $community->id]) }}" class="button-card view-button">
                    Create Advertisement
                </a>
            </div>
        </div>
    </div>
@endsection