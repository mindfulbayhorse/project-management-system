@extends('layout')

@section('title') {{$project->title}} @endsection

@section('left_sidebar')
	<h2>@yield('section_title')</h2>
	<h1>@yield('title')</h1>
	
	@include('projects.wbs.tree') 
@endsection

@section('content')
<main>
	@include('projects.info')
	
	<a href="/projects/{{$project->id}}/edit" class="btn">Edit project</a>

	<div id="WBS">
		@include('projects.deliverables.info')
		
		@include('projects.deliverables.create')
		
		@include('projects.wbs.table')
	</div>
</main>
@endsection