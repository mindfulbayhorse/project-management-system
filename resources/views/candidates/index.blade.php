@extends('layout')

@section('title','List of candidates')

@section('content')

<a href="/candidates/create" class="btn">Add candidate</a>
<main>
    <ul class="candidates_list">
        @forelse ($candidates as $candidate)
            <li>
                <a href="/candidates/{{$candidate->id}}">{{ $candidate->first_name }}, 
                    {{ $candidate->last_name }}, {{ $candidate->email }}</a>
            </li>
        @empty
            <div>No candidates have been added yet.</div>
        @endforelse
    
    </div>
    
</main>
@endsection