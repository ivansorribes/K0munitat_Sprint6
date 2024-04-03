@extends('layout.basic')

@section('title', $blog->title)

@section('content')
<body class="bg-gray-100 mt-16">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-full bg-white rounded-lg shadow-md overflow-hidden"> <!-- Cambiamos max-w-4xl a max-w-full -->
            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $blog->title }}</h1>
                <p class="text-lg text-gray-600 mb-4">{{ $blog->description }}</p>
            </div>
            @if($blog->post_image)
            <div class="px-8 py-6">
                <img src="/img/fotosblog/{{ $blog->post_image }}" alt="{{ $blog->title }}" class="max-w-full h-auto">
            </div>
            @endif
            <div class="border-t border-gray-200 px-8 py-6 bg-gray-50">
                <!-- Sección de comentarios, si lo deseas -->
            </div>
        </div>
    </div>
</body>
@endsection
