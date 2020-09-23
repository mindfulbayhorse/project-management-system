@extends('layout')

@section('left_sidebar')
	@section('section_title') Work breakdown structure @endsection
	@section('title') {{$project->title}} @endsection
@endsection

@section('content')
<main>
	@include('projects.info')
    
</main>
@endsection