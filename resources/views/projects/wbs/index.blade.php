@extends('nav_left')

@section('title')
   {{$project->title}}
@endsection

@section('content')

<main>
    <div class="text_part">
        <div class="flex_block one_row">
            <label for="status">Status:</label>
            <p>{{$project->status['name']}}</p>
        </div>  
        
        <div class="flex_block one_row">
            <label for="started">Start date:</label>
            <p>{{$project->started}}</p>
        </div> 
        
        <div class="flex_block one_row">
            <label for="finished">Comletion date:</label>
            <p>{{$project->finished}}</p>
        </div>   
        
        <a href="/projects/{{$project->id}}/edit" class="btn">Edit project</a> 
        
        <div id="WBS">
            @include('projects.wbs.new')
    
            @include('projects.wbs.table')  
        </div>
    </div>        

</main>
@endsection