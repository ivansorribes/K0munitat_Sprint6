@extends('layout.basic')
@section('title', 'EditPersonalProfile')
@section('content')
<div id="personalProfile"></div>
<script>
    window.csrf_token = "{{ csrf_token() }}";
</script>

@endsection
