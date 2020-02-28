@extends('nav_left')

@section('title')
   {{$project->title}}
@endsection

@section('left_sidebar')
   <div class="section_title">Work breakdown structure</div>
   <h1>{{$project->title}}</h1>
   
   @include('projects.wbs.tree')
   
@endsection

@section('content')

    <div class="center_area">
         @include('projects.info')
    
        <a href="/projects/{{$project->id}}/edit" class="btn">Edit project</a> 
        <a href="/projects/{{$project->id}}/edit" class="btn">Edit project</a> 
        
        <div id="WBS">
            @include('projects.info')

			@include('projects.deliverables.create')

			@include('projects.wbs.table') 
        </div>
    </div>     

@endsection