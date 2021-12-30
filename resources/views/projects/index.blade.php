@extends('layout')

@section('title','List of projects')

@section('content')
<a href="/projects/create" class="btn">Add project</a>
<main>
    <div class="projects_groups">
        @forelse ($projects as $project)
                
	        <div class="card">
                <h2><a href="{{$project->path()}}">{{$project->title}}</a></h2>
                <div class="card-body">
                    <div class="card-text">
                        @if ($project->status) 
                            <p>{{ $project->status->name }}</p>
                         @endif
                        <p>{{ $project->started }}</p>
                        <p>{{ $project->finished }}</p>
                    </div>
                  
                    <nav>
                        @if ($project->wbs->count() > 0)
                        <a href="{{ $project->wbs[0]->path() }}">WBS</a>
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