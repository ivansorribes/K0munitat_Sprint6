<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create advertisement</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <style>
        .eye-icon {
            cursor: pointer;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-white">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-2xl sm:rounded-3xl sm:p-20 w-full max-w-md text-center">
            <h2 class="text-2xl font-semibold mb-6 text-center text-yellow-600">Create post form</h2>
            <form action="{{ route('form-create-post-post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="post">
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
                        type
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

</html>