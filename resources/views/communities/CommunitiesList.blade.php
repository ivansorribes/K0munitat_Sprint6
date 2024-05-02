@extends('layout.basic')
@section('title', 'Community List')

@section('content')
        <div id="communityList"></div>
        
         <input type="hidden" name="regionId" id="regionId" value="{{ $regionId }}">
@endsection