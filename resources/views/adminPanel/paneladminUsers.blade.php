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
        <div class="container mx-auto p-8">
            <h1 class="text-2xl font-bold mb-4">Users List</h1>

            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200 px-2 py-2">Name</th>
                        <th class="border border-gray-200 px-2 py-2">Email</th>
                        <th class="border border-gray-200 px-2 py-2">Username</th>
                        <th class="border border-gray-200 px-2 py-2">Phone</th>
                        <th class="border border-gray-200 px-2 py-2">City</th>
                        <th class="border border-gray-200 px-2 py-2">Role</th>
                        <th class="border border-gray-200 px-2 py-2">Is Active</th>
                        <th class="border border-gray-200 px-2 py-2">Guardar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <form action="{{ route('updateUser', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td class="border border-gray-200 px-2 py-2"><input type="text" name="firstname" value="{{ $user->firstname }}"></td>
                            <td class="border border-gray-200 px-2 py-2"><input type="email" name="email" value="{{ $user->email }}"></td>
                            <td class="border border-gray-200 px-2 py-2"><input type="text" name="username" value="{{ $user->username }}"></td>
                            <td class="border border-gray-200 px-2 py-2"><input type="tel" name="telephone" value="{{ $user->telephone }}"></td>
                            <td class="border border-gray-200 px-2 py-2"><input type="text" name="city" value="{{ $user->city }}"></td>
                            <td class="border border-gray-200 px-2 py-2">{{ $user->role }}</td>
                            <td class="border border-gray-200 px-2 py-2">
                                <button type="submit" class="btn btn-sm {{ $user->isActive ? 'btn-danger' : 'btn-success' }}">
                                    {{ $user->isActive ? 'Deactivate' : 'Activate' }}
                                </button>
                            </td>
                            <td class="border border-gray-200 px-2 py-2"><button class="btn btn-sm bg-green-500 text-white px-2 py-1 rounded" type="submit">Save</button></td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>