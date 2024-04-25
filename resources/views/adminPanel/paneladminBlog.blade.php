@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')

<body class="flex">

    <div class="flex-1">
        
        <div class="mt-10 container mx-auto p-8">
        <h1 class=" mt-4 text-2xl mb-5">
                Blog Posts List
            </h1>
            <div class="flex mb-4 justify-end">
                <a href="{{ route('blog.create') }}" class="btn btn-sm px-2 py-1 text-white bg-neutral border border-transparent rounded-md active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-purple">Create New Blog Post</a>
            </div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs overflow-x-auto">
                <table class="min-w-full text-left text-sm font-light">
                    <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th class="px-6 py-4">Title</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4">Post Image</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-normal px-6 py-4">{{ $blog->title }}</td>
                            <td class="whitespace-normal px-6 py-4">{{ $blog->description }}</td>
                            <td class="whitespace-normal px-6 py-4">{{ $blog->post_image }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <form method="GET" action="{{ route('blog.edit', $blog->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm px-2 py-1 text-white bg-neutral border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple">Edit</button>
                                </form>
                                <form method="POST" action="{{ route('blog.destroy', $blog->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm px-2 py-1 text-white bg-neutral border border-transparent rounded-md active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
@endsection

</html>