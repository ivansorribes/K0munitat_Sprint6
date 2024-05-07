<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">

<!-- userDetails.blade.php -->
@extends('adminPanel.layout')

@section('title', 'User Details')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="mt-20 text-2xl mb-5">
        User details
    </h1>
    <form action="{{ route('updateUser', ['id' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @if ($errors->any())
            <div class="alert bg-red-200">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Display success message -->
            @if (session('success'))
            <div class="alert bg-green-400" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                {{ session('success') }}
            </div>
            @endif
            <div class="flex flex-wrap -mx-2 mt-5">
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                        Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" name="firstname" type="text" placeholder="Firstname" value="{{ $user->firstname }}">
                </div>
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                        Lastname
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" name="lastname" type="text" placeholder="Lastname" value="{{ $user->lastname }}">
                </div>
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" placeholder="Username" value="{{ $user->username }}">
                </div>
                <div class="px-2 md:w-1/3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                        Role
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" name="role">
                        <option value="superAdmin" {{ $user->role == 'superAdmin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="communityAdmin" {{ $user->role == 'communityAdmin' ? 'selected' : '' }}>Community Admin</option>
                        <option value="communityMod" {{ $user->role == 'communityMod' ? 'selected' : '' }}>Community Moderator</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="px-2 mb-4 md:w-2/3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="profile_image">
                    Profile Image
                </label>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
            </div>

            <!-- Imagen de perfil actual -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="current_profile_image">
                    Current Profile Image
                </label>
                @if ($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="w-32 h-32 object-cover rounded-full"> @else
                <img src="{{ asset('/img/defaultImage.jpg') }}" alt="Default Image" class="w-32 h-32 object-cover rounded-full">
                @endif
            </div>

            <div class="flex flex-wrap -mx-2">
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="city">
                            City
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="city" name="city" type="text" placeholder="City" value="{{ $user->city }}">
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="postcode">
                            Post code
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="postcode" name="postcode" type="text" placeholder="Post Code" value="{{ $user->postcode }}">
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">
                            Telephone
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone" name="telephone" type="text" placeholder="Telephone" value="{{ $user->telephone }}">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="profiledescription">
                    Profile description
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="profile_description" name="profile_description" type="text" placeholder="Profile description" value="{{ $user->profile_description}}">
            </div>
            <div class="flex flex-wrap -mx-2">

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="createdat">
                        Created at
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="created_at" name="created_at" type="text" placeholder="Created at" value="{{ $user->created_at }}" readonly disabled>
                </div>
                <div class="w-full md:w-1/2 px-2 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="updateat">
                        Updated at
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="updated_at" name="updated_at" type="text" placeholder="Updated at" value="{{ $user->updated_at }}" readonly disabled>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <!-- Agregamos un contenedor flex para alinear el botón a la derecha -->
                <div></div>
                <button class="btn btn-sm px-4 py-1 text-white bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit">
                    Save
                </button>
            </div>
            <!-- Agrega más campos aquí según sea necesario -->
            <!-- Mensaje de confirmación -->



        </div>


    </form>


</div>


@endsection