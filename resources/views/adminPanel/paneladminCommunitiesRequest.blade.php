@extends('adminPanel.layout')

@section('title', 'Dashboard')

@section('content')

<body>
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h1 class="mt-20 text-2xl mb-5">
                Communities list
            </h1>

            <!-- baix del header -->

            <!-- Cards -->
--

            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs overflow-x-auto mb-20">
                <div class="max-h-[calc(100vh-100px)] overflow-y-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">Community Admin</th>
                                <th scope="col" class="px-6 py-4">Name</th>
                                <th scope="col" class="px-6 py-4">Creation Date</th>
                                <th scope="col" class="px-6 py-4">State</th>
                                <th scope="col" class="px-6 py-4">User List</th>
                                <th scope="col" class="px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($communities as $community)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4">
                                    {{ $community->admin->username }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    {{ $community->name }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    {{ $community->created_at }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if($community->isActive)
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-700">
                                        Active &#10004;
                                    </span>
                                    @else
                                    <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                        Inactive &#10008;
                                    </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <form action="{{ route('showUsers', $community->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm px-2 py-1 text-white bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            Users
                                        </button>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <form action="{{ route('stateChange', $community->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="{{ $community->isActive ? 'bg-red-500' : 'bg-green-500' }} btn btn-sm px-2 py-1 text-white border border-transparent rounded-md">
                                            {{ $community->isActive ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
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