<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">


<!-- otra_vista.blade.php -->
@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')

<body>
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h1 class="mt-20 text-2xl mb-5">
                Posts list
            </h1>

            <!-- baix del header -->

            <!-- Cards -->

            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">Community</th>
                                <th scope="col" class="px-6 py-4">User</th>
                                <th scope="col" class="px-6 py-4">Title</th>
                                <th scope="col" class="px-6 py-4">Show/Edit</th>
                                <th scope="col" class="px-6 py-4">State</th>
                                <th scope="col" class="px-6 py-4">Change State</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            @if($post->type == 'post')
                            <tr class="border-b dark:border-neutral-500">

                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $post->community->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $post->user->username }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $post->title }}</td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <a href="{{ route('post.show', ['post' => $post->id]) }}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Show/Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                </td>


                                <td class="whitespace-nowrap px-6 py-4" style="white-space: nowrap;">
                                    @if($post->isActive)
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-700">Active &#10004;</span>
                                    @else
                                    <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">Inactive &#10008;</span>
                                    @endif
                                </td>
                                <form action="{{ route('posts.toggle', ['post' => $post->id]) }}" method="POST">

                                    <td class="whitespace-nowrap px-6 py-4">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-sm {{ $post->isActive ? 'bg-red-500' : 'bg-green-500' }} text-white px-2 py-1 rounded-md">
                                            {{ $post->isActive ? 'Deactivate' : 'Activate' }}
                                        </button>

                                    </td>
                                </form>

                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
@endsection


</html>