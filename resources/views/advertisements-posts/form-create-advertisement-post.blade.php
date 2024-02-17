<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Advertisement / Post</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</head>
@include('header.header')

<body>
    <div class="flex justify-center items-center p-12 min-h-screen">
        <div class="w-full max-w-[700px]">
            <h1 class="text-4xl font-bold mb-5">Create Advertisement / Post</h1>
            <form action="{{ route('form-create-advertisement-post-post', ['community' => $communityId]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <select name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="post">Post</option>
                    <option value="advertisement">Advertisement</option>
                </select>
                <div class=" mb-4 relative">
                    <label for="title" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Title
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600" placeholder="Nombre" />
                    @error('firstname')
                    <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label for="description" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Description
                    </label>
                    <input type="text" id="description" name="description" value="{{ old('description') }}" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600" placeholder="Apellido" />
                    @error('lastname')
                    <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label for="category_id" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Category
                    </label>
                    <select name="category_id" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600">
                        <option value="">Select an option</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select> @error('username')
                    <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <label for="private">Private</label>
                <input type="checkbox" id="private" name="private" value="1">

                <div class="flex items-center justify-center w-full">
                    <label for="image">Imagen:</label>
                    <input type="file" id="image" name="image">
                </div>
                <button type="submit" class="w-full bg-yellow-500 text-white p-3 rounded hover:bg-yellow-600 transition duration-300 mb-4">
                    Submit
                </button>
            </form>

        </div>
    </div>
</body>
@include('footer.footer')