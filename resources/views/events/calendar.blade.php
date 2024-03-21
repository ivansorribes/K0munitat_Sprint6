@extends('layout.basic')

@section('title', 'event')

@section('content')
        @csrf

        <h1 >Calendar Events</h1>
        <div id = "MyCalendar" ></div>
        
        <script>
                window.csrf_token = "{{ csrf_token() }}";
        </script>

@endsection