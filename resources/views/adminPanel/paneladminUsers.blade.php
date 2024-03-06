<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 - REACT 18</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body class="flex">
    <div id="sidebar-container"></div>

    <div class="flex-1">
        <div class="container mx-auto p-8 pl-64">
            <h1 class="text-2xl font-bold mb-4 ml-4">Users List</h1>

            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-2 py-2">Name</th>
                                        <th scope="col" class="px-2 py-2">Email</th>
                                        <th scope="col" class="px-2 py-2">Username</th>
                                        <th scope="col" class="px-2 py-2">Phone</th>
                                        <th scope="col" class="px-2 py-2">City</th>
                                        <th scope="col" class="px-2 py-2">Role</th>
                                        <th scope="col" class="px-2 py-2">Is Active</th>
                                        <th scope="col" class="px-2 py-2">Guardar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr class="border-b dark:border-neutral-500">
                                        <form action="{{ route('updateUser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td class="whitespace-nowrap px-2 py-2"><input type="text" name="firstname" value="{{ $user->firstname }}"></td>
                                            <td class="whitespace-nowrap px-2 py-2"><input type="email" name="email" value="{{ $user->email }}"></td>
                                            <td class="whitespace-nowrap px-2 py-2"><input type="text" name="username" value="{{ $user->username }}"></td>
                                            <td class="whitespace-nowrap px-2 py-2"><input type="tel" name="telephone" value="{{ $user->telephone }}"></td>
                                            <td class="whitespace-nowrap px-2 py-2"><input type="text" name="city" value="{{ $user->city }}"></td>
                                            <td class="whitespace-nowrap px-2 py-2">{{ $user->role }}</td>
                                            <td class="whitespace-nowrap px-2 py-2">
                                                <button type="submit" class="btn btn-sm {{ $user->isActive ? 'btn-danger' : 'btn-success' }}">
                                                    {{ $user->isActive ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </td>
                                            <td class="whitespace-nowrap px-2 py-2">
                                                <button class="btn btn-sm bg-green-500 text-white px-2 py-1 rounded" type="submit">Save</button>
                                            </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>


</html>