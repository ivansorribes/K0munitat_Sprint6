@extends('layout.basic')

@section('title', 'Create Community')

@section('content')
        <input id= "id_user" type="hidden" value = "{{ Auth()->user()->id}}">
        <div id="communityForm"></div>
@endsection