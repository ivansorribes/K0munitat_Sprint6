<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'theme-dark': dark }" x-data="data()">


<!-- otra_vista.blade.php -->
@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')

<body>
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Dashboard
            </h2>
            <!-- baix del header -->
            <div class="flex-1">
                <div class="container mx-auto p-8">
                    <h1 class="text-2xl font-bold mb-4">Listado de Usuarios de la Comunidad {{ $community->name }} </h1>
                </div>
            </div>
            <!-- Cards -->


            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">User</th>
                                <th class="px-4 py-3">Mail</th>
                                <th class="px-4 py-3">Posts</th>
                                <th class="px-4 py-3">Comments</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">@foreach($users as $index => $user)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar with inset shadow -->
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                            @if ($user->profile_image)
                                            <img class="object-cover w-full h-full rounded-full" src="{{ $user->profile_image }}" alt="" loading="lazy" />
                                            @else
                                            <img class="object-cover w-full h-full rounded-full" src="https://qksol.com/wp-content/uploads/2017/05/slujangfmca-com.jpeg" alt="" loading="lazy" />

                                            @endif
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>

                                        <div>
                                            <p class="font-semibold">{{ $user->username }} {{ $user->id }} </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $user->role }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Posts
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Comments
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">

                                        <button onclick="sendForm('{{ $index }}')" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete"> <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <form id="form{{ $index }}" action="{{ route('delUserFromCommunity', ['id' => $user->id, 'id_community' => $community->id ]) }}" method="POST"> @csrf
                                @method('PUT')

                            </form>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        </div>
    </main>

    <script>
        function sendForm(form) {
            document.forms[form].submit()
        }
    </script>


</body>
<script src="{{ asset('js/adminpanel/focus-trap.js') }}"></script>
<script src="{{ asset('js/adminpanel/init-alphine.js') }}"></script>

@endsection

</html>