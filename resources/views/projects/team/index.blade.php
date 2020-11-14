@extends('layout')

@section('title','Project team')

@section('content')
<a href="{{ $project->path() }}/team/edit" 
    class="btn">Edit team</a>
<main>
    <div class="members_groups">
        @forelse ($project->team as $member)
                
	        <div class="card">
	              <div class="card-body">
                    <a href="/candidated/{{$member->id}}" class="card-title">{{$member->name}}</a>
                    <div class="card-text">
                        <p>{{$member->email}}</p>
                    </div>
	              </div>
	        </div>
        @empty
            <div>No member have been added yet.</div>
	    @endforelse
    
    </div>
    
</main>
@endsection