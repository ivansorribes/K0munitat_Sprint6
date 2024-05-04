@extends('layout.basic')
@section('title', 'Personal Profile')
@section('content')
<div id="personalProfile"></div>
<script>
    window.csrf_token = "{{ csrf_token() }}";
</script>

@endsection
