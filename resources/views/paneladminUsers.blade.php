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

<body>
    <h1>Users List</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Phone</th>
                <th>City</th>
                <th>Role</th>
                <th>Is Active</th>
                <th>Guardar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <form action="{{ route('updateUser', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <td><input type="text" name="firstname" value="{{ $user->firstname }}"></td>
                    <td><input type="email" name="email" value="{{ $user->email }}"></td>
                    <td><input type="text" name="username" value="{{ $user->username }}"></td>
                    <td><input type="tel" name="telephone" value="{{ $user->telephone }}"></td>
                    <td><input type="text" name="city" value="{{ $user->city }}"></td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <button type="submit">
                            @if($user->isActive)
                            Deactivate
                            @else
                            Activate
                            @endif
                        </button>
                    </td>
                    <td><button type="submit">Guardar cambios</button></td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>