@extends('nav_left')

@section('title')
   {{$project->title}}
@endsection

@section('left_sidebar')
   <h1>{{$project->title}}</h1>
@endsection

@section('content')

    <div class="limit_area">
         @include('projects.info')
    
        <a href="/projects/{{$project->id}}/edit" class="btn">Edit project</a> 
        
        <div id="WBS">
            @include('projects.wbs.index')
        </div>
    </div>     

@endsection