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
    <div class="flex justify-center items-center bg-gray-100 p-6 min-h-screen">
        <div class="relative py-3 sm:max-w-xl mx-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold text-secondary mb-6">Create Advertisement/Post</h1>
                    </div>
                    <form action="{{ route('form-create-advertisement-post-post', ['community' => $communityId]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Type</label>
                            <div class="flex justify-between">
                                <div class="flex items-center mb-2">
                                    <input id="post" name="type" type="radio" value="post" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="post" class="ml-2 block text-sm text-gray-900">Post</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input id="advertisement" name="type" type="radio" value="advertisement" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="advertisement" class="ml-2 block text-sm text-gray-900">Advertisement</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Title" />
                            @error('title')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Description</label>
                            <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Description">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 text-sm font-medium mb-2">Category</label>
                            <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select an option</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="private" name="private" value="1" class="mr-2">
                            <label for="private" class="text-gray-700 text-sm font-medium">Private</label>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-medium mb-2">Image:</label>
                            <input type="file" id="image" name="image" class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-white hover:file:bg-yellow-600">
                        </div>
                        <button type="submit" class="w-full bg-yellow-500 text-white font-semibold p-3 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 transition duration-300">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>


@include('footer.footer')