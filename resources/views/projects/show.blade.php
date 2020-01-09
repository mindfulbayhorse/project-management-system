@extends('layout')

@section('title')
   {{$project->title}}
@endsection

@section('content')

<main>        
        <div class="flex_block one_row">
            <label for="status">Status:</label>
            <p>{{$project->status}}</p>
        </div>  
        
        <div class="flex_block one_row">
            <label for="started">Start date:</label>
            <p>{{$project->started}}</p>
        </div> 
        
        <div class="flex_block one_row">
            <label for="finished">End date:</label>
            <p>{{$project->finished}}</p>
        </div>   
        
        <a href="/projects/{{$project->id}}/edit" class="btn">Edit project</a> 
        
        <div id="WBS">
            @include('projects.deliverables.create')
    
            @include('projects.deliverables.table')  
        </div>

</main>
@endsection