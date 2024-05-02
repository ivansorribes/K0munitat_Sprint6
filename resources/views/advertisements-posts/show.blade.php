@extends('layout.basic')

@section('title', 'Advertisement / Post')

@section('content')
<input id="id_user" type="hidden" value="{{ Auth()->user()->id}}">
<input id="username" type="hidden" value="{{ Auth()->user()->username}}">
<div id="advertisementDetails"></div>
<!-- <div id="advertisementComments"></div> -->
@endsection