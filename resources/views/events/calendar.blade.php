@extends('layout.basic')

@section('title', 'event')

@section('content')

        <h1 class="mt-24 text-6xl text-center">Calendar Events</h1>
        <div id = "MyCalendar" ></div>
        
        <script>
                window.csrf_token = "{{ csrf_token() }}";
        </script>

@endsection