<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">


<!-- otra_vista.blade.php -->
@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')

<body>
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h1 class="mt-20 text-2xl">
                User List
            </h1>



            <!-- baix del header -->
            <div class="flex justify-end mb-5">
                <a href="{{ route('createUserForm') }}" class="btn btn-sm px-2 py-1 text-white bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create User <span class="ml-2" aria-hidden="true">+</span>
                </a>
            </div>


            <!-- Cards -->

            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-2 py-2">Name</th>
                                <th scope="col" class="px-2 py-2">Email</th>
                                <th scope="col" class="px-2 py-2">Username</th>
                                <th scope="col" class="px-2 py-2">City</th>
                                <th scope="col" class="px-2 py-2">State</th>
                                <th scope="col" class="px-2 py-2">Change State</th>
                                <th scope="col" class="px-2 py-2">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="border-b dark:border-neutral-500">

                                <td class="whitespace-nowrap px-2 py-2">{{ $user->firstname }}</td>
                                <td class="whitespace-nowrap px-2 py-2">{{ $user->email }}</td>
                                <td class="whitespace-nowrap px-2 py-2">{{ $user->username }}</td>
                                <td class="whitespace-nowrap px-2 py-2">{{ $user->city }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if($user->isActive)
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-700">
                                        Active &#10004;
                                    </span>
                                    @else
                                    <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                        Inactive &#10008;
                                    </span>
                                    @endif
                                </td>
                                <form action="{{ route('users.toggleIsActive', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <td class="whitespace-nowrap px-2 py-2">

                                        <button type="submit" class="{{ $user->isActive ? 'bg-red-500' : 'bg-green-500' }} btn btn-sm px-2 py-1 text-white border border-transparent rounded-md">
                                            {{ $user->isActive ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </td>
                                </form>

                                <td class="whitespace-nowrap px-2 py-2">
                                    <a href="{{ route('users.detail', ['id' => $user->id]) }}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                </td>


                            </tr>
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