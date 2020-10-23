@extends('layout')

@section('title','List of projects')

@section('content')
<a href="/projects/create" class="btn">Add project</a>
<main>
    <div class="projects_groups">
        @forelse ($projects as $project)
                
	        <div class="card" style="width: 25%;">
	              <div class="card-body">
                    <a href="{{$project->path()}}" class="card-title">{{$project->title}}</a>
                    <div class="card-text">
                        <p>@if ($project->status) {{ $project->status->name }} @endif</p>
                        <p>{{ $project->started }}</p>
                        <p>{{ $project->finished }}</p>
                    </div>
	              </div>
	        </div>
        @empty
            <div>No projects have been added yet.</div>
	    @endforelse
    
    </div>
    
</main>
@endsection