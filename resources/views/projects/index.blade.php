@extends('layout')

@section('title','List of projects')

@section('last_project')

    @include('blocks.last_project', ['lastProject'=>$lastProject]) 

@endsection

@section('content')
<a href="/projects/create" class="btn">Add project</a>
<main>
    <div class="projects_groups">
        @forelse ($projects as $project)
                
	        <div class="card">
                <a href="{{$project->path()}}" 
                    class="title">{{$project->title}}</a>
                <div class="card-body">
                    <div class="card-text">
                        <p>@if ($project->status) {{ $project->status->name }} @endif</p>
                        <p>{{ $project->started }}</p>
                        <p>{{ $project->finished }}</p>
                    </div>
                  
                    <nav>
                        @if ($project->wbs()->actual()[0]->deliverables->count() > 0)
                            <a href="{{ $project->wbs()->actual()[0]->path() }}">WBS</a>
                        @endif
                        
                        @if ($project->team->count() > 0)
                            <a href="{{ $project->path() }}/team">Team</a>
                        @endif
                    
                    </nav>
                   
                </div>
	        </div>
        @empty
            <div>No projects have been added yet.</div>
	    @endforelse
    
    </div>
    
</main>
@endsection