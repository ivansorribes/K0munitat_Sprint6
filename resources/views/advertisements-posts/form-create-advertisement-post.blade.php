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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>
@include('header.header')

<body>

    <script>
        $(document).ready(function() {
            $("#yourFormId").submit(function(event) {
                var isValid = true;
                var errors = [];
                var $errorMessages = $("#errorMessages");
                $errorMessages.hide();
                $("#errorList").empty();
                if (!$('input[name="type"]:checked').length) {
                    errors.push("<li>Please select a type.</li>");
                    isValid = false;
                }
                var title = $("#title").val().trim();
                if (title === "") {
                    errors.push("<li>Title is required.</li>");
                    isValid = false;
                }
                var description = $("#description").val().trim();
                if (description === "") {
                    errors.push("<li>Description is required.</li>");
                    isValid = false;
                }
                var categoryId = $("#category_id").val();
                if (categoryId === "") {
                    errors.push("<li>Please select a category.</li>");
                    isValid = false;
                }
                if (!isValid) {
                    $("#errorList").html(errors.join(""));
                    $errorMessages.show();
                    event.preventDefault();
                }
            });
            $(document).on('click', '#errorMessages svg', function() {
                $("#errorMessages").hide();
            });
        });
    </script>
    <div class="flex justify-center items-center bg-gray-100 p-6 min-h-screen">
        <div class="relative py-3 sm:max-w-xl mx-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold text-secondary mb-6">Create Advertisement/Post</h1>
                    </div>
                    <div id="errorMessages" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                        <span class="block sm:inline">Please correct the following errors:</span>
                        <ul id="errorList"></ul>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="document.getElementById('errorMessages').classList.add('hidden');" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                    <form id="yourFormId" action="{{ route('form-create-advertisement-post-post', ['community' => $communityId]) }}" method="post" enctype="multipart/form-data">
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
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Description</label>
                            <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Description">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 text-sm font-medium mb-2">Category</label>
                            <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select an option</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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