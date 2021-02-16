@extends('layout')

@section('title','List of projects')

@section('content')
<a href="/suppliers/create" class="btn">Add supplyer</a>
<main>
    <div class="projects_groups">
        @forelse ($supplyers as $supplyer)
                
	        <div class="card">
                <a href="{{$supplier->path()}}" 
                    class="title">{{$supplyer->name}}</a>
                <div class="card-body">
                    <div class="card-text">
                        <p>{{ $supplyer->url }}</p>
                    </div>
                   
                </div>
	        </div>
        @empty
            <div>No projects have been added yet.</div>
	    @endforelse
    
    </div>
    
</main>
@endsection