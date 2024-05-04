

@extends('layout.basic')
@section('title', 'Edit Profile')
@section('content')
<div id="EditPersonalProfile"></div>
<script>
    window.csrf_token = "{{ csrf_token() }}";
</script>

@endsection
