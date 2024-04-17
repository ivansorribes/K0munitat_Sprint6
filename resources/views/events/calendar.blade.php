@extends('layout.basic')

@section('title', 'event')

@section('content')

        <h1 class="mt-24 text-6xl text-center">Calendar Events</h1>
        <div id = "MyCalendar" ></div>

        <div class="max-w-5xl mx-auto mt-8">
    <div class="border-l-2 border-gray-500 pl-8">
        <div class="flex flex-col md:flex-row md:justify-between">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2">Event 1</h3>
                <p class="text-gray-600 text-sm">Date: January 1, 2022</p>
            </div>
            <p class="text-gray-700">Some description goes here...</p>
        </div>
        <div class="flex flex-col md:flex-row md:justify-between mt-8">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2">Event 2</h3>
                <p class="text-gray-600 text-sm">Date: February 1, 2022</p>
            </div>
            <p class="text-gray-700">Some description goes here...</p>
        </div>
        <div class="flex flex-col md:flex-row md:justify-between mt-8">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2">Event 3</h3>
                <p class="text-gray-600 text-sm">Date: March 1, 2022</p>
            </div>
            <p class="text-gray-700">Some description goes here...</p>
        </div>
        <div class="flex flex-col md:flex-row md:justify-between mt-8">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2">Event 4</h3>
                <p class="text-gray-600 text-sm">Date: April 1, 2022</p>
            </div>
            <p class="text-gray-700">Some description goes here...</p>
        </div>
    </div>
</div>
        
        <script>
                window.csrf_token = "{{ csrf_token() }}";
        </script>
@endsection