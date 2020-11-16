@extends('projects.show')

@section('indicators')
    
    <div class="project">
        <p><b>Status:</b>@if ($project->status) {{$project->status->name}} @endif</p>
   
    	<p><b>Start date:</b>{{$project->started}}</p>
    
    	<p><b>Comletion date:</b>{{$project->finished}}</p>
    
    	<a href="{{ $project->path() }}/edit" class="btn">Edit project</a>
    </div>

@endsection
