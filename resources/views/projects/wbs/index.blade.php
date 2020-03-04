@extends('nav_left_request')

@section('title')
    {{$project->title}}
@endsection

@section('left_sidebar')
   <h2>Work breakdown structure</h2>
   <h1>{{$project->title}}</h1>
   
   @include('projects.wbs.tree')
   
@endsection

@section('content')

	<div class="center_area">
        @include('projects.info')

		@include('projects.deliverables.create')

		@include('projects.deliverables.table') 
	</div>
@endsection

