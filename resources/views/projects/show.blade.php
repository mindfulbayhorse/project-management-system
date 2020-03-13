@extends('layout')

@section('left_sidebar')
	@section('section_title') Work breakdown structure @endsection
	@section('title') {{$project->title}} @endsection
	
	@include('projects.wbs.tree')
@endsection

@section('content')
<main>
	@include('projects.info')

	<div id="WBS">

		@include('projects.wbs.index')
	
	</div>
</main>
@endsection