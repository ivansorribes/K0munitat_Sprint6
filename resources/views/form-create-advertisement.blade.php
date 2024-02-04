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
            <h2 class="text-2xl font-semibold mb-6 text-center text-yellow-600">Create advertisement form</h2>
            <form action="{{ route('form-create-advertisement-post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="advertisement">
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

                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" />
                    </label>

                </div>
                <button type="submit" class="w-full bg-yellow-500 text-white p-3 rounded hover:bg-yellow-600 transition duration-300 mb-4">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            if (type === 'password') {
                togglePassword.innerHTML = '<i class="far fa-eye"></i>';
            } else {
                togglePassword.innerHTML = '<i class="far fa-eye-slash"></i>';
            }
        });

        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirm = document.getElementById('password_confirm');

        togglePasswordConfirm.addEventListener('click', function() {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            if (type === 'password') {
                togglePasswordConfirm.innerHTML = '<i class="far fa-eye"></i>';
            } else {
                togglePasswordConfirm.innerHTML = '<i class="far fa-eye-slash"></i>';
            }
        });
    </script>
</body>

</html>
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
            <h2 class="text-2xl font-semibold mb-6 text-center text-yellow-600">Create advertisement form</h2>
            <form action="{{ route('form-create-advertisement-post') }}" method="post">
                @csrf

                <div class="mb-4 relative">
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
                    <label for="username" class="block text-gray-600 text-sm font-medium mb-2 text-yellow-600">
                        Category
                    </label>
                    <select id="username" name="username" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-yellow-600">
                        <option value="">Selecciona una opción</option>
                        <!-- Opciones del select aquí -->
                    </select> @error('username')
                    <div class="alert alert-danger mb-5" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-yellow-500 text-white p-3 rounded hover:bg-yellow-600 transition duration-300 mb-4">
                    Submit
                </button>
            </form>
        </div>
    </div>

</body>

</html>