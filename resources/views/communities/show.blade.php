<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ًCommunities Edit</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body>
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

</html>