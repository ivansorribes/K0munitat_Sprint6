@extends('layout.basic')

@section('title', 'K0munitat')

@section('content')

<body class="justify-center items-center" style="background-image: url('{{ asset('img/wallpaper.webp') }}'); background-size: cover; background-position: center;">
    <!-- Callout -->
    <section aria-labelledby="sale-heading" class="relative mx-auto flex max-w-7xl flex-col items-center px-4 pt-32 text-center sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-none">
            <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-black sm:text-5xl lg:text-6xl">Explore our wide variety of communities</h2>
            <p class="mx-auto mt-4 max-w-xl text-xl text-black">Join a community to interact with its users and exchange products and tools</p>
            <a href="{{ route('communities.index') }}" class="mt-6 inline-block w-full rounded-md border border-transparent bg-gray-900 px-8 py-3 font-medium text-white hover:bg-cyan-800 sm:w-auto">Find your community
            </a>

        </div>
    </section>
    <div class="flex justify-center mt-10">
        <div id="map"></div>
    </div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 lg:py-10">
        <div id="exchanges"></div>
    </div>

</body>
@endsection