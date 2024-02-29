@extends('layout.basic')

@section('title', 'event')

@section('content')
        @csrf
        <div id = "MyCalendar" ></div>

@endsection