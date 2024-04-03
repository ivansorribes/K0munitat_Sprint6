@extends('layout.basic')

@section('title', 'Blog')

@section('content')
    @csrf 
        <div id="blog"></div>
        <script type="text/javascript">
            window.blogData = @json($blog);
        </script>
@endsection