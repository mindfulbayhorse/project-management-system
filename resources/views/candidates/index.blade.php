@extends('layout')

@section('title','List of candidates')

@section('content')

<a href="/candidates/create" class="btn">Add candidate</a>
<main>
    <ul class="candidates_list">
        @forelse ($candidates as $candidate)
            <li>{{ $candidate->name }}, {{ $candidate->email }}</li>
        @empty
            <div>No candidates have been added yet.</div>
        @endforelse
    
    </div>
    
</main>
@endsection