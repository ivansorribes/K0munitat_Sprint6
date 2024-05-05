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
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Username</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Last Name</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach($users as $index => $user)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                
                                        <div>
                                            <p class="font-semibold">{{ $user->username }} </p>
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
                                    {{ $user->firstname }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->lastname }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($user->request_status == 'pending')
                                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente</span>
                                    @elseif($user->request_status == 'accepted')
                                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full">Aceptado</span>
                                    @elseif($user->request_status == 'denied')
                                        <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full">Denegado</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($user->request_status == 'pending')
                                        <form action="{{ route('acceptRequest', ['userId' => $user->id, 'communityId' => $community->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Aceptar</button>
                                        </form>
                                        <form action="{{ route('denyRequest', ['userId' => $user->id, 'communityId' => $community->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Denegar</button>
                                        </form>
                                    @endif
                                </td>
                                
                                
                            </tr>
                            
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