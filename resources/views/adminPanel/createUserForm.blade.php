<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">


<!-- otra_vista.blade.php -->
@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')

<body>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-4">Create User</h2>
        <form action="{{ route('storeUser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">Name</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" name="firstname" type="text" placeholder="Firstname">
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">Lastname</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" name="lastname" type="text" placeholder="Lastname">
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" placeholder="Username">
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" name="role">
                            <option value="superAdmin">Super Admin</option>
                            <option value="communityAdmin">Community Admin</option>
                            <option value="communityMod">Community Moderator</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Email">
                    </div>
                    <div class="w-full px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="profile_image">Profile Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="city">City</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="city" name="city" type="text" placeholder="City">
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="postcode">Post code</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="postcode" name="postcode" type="text" placeholder="Post Code">
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">Telephone</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone" name="telephone" type="text" placeholder="Telephone">
                    </div>
                    <div class="w-full px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="profiledescription">Profile description</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="profile_description" name="profile_description" type="text" placeholder="Profile description">
                    </div>
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Confirm Password</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password">
                    </div>



                </div>
                <div class="flex items-center justify-between">
                    <div></div>
                    <div>
                        <button class="btn btn-sm px-2 py-1 text-white bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit">Create User</button>
                    </div>
                </div>

            </div>

        </form>
    </div>

</body>
@endsection


</html>