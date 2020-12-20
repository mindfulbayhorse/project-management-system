@extends('layout')

@section('title','Equipment')

@section('content')
<a href="{{ route('equipment.create') }}" class="btn">Add equipment</a>
<main>
    <div class="projects_groups">
        @forelse ($equipment as $item)
                
            <div class="card">
                <a href="{{ $item->path() }}" 
                    class="title">{{ $item->name }}</a>
                <div class="card-body">
                    <div class="card-text">
                        <p>{{ $item->type }}</p>
                        <p>{{ $item->model }}</p>
                    </div>                   
                </div>
            </div>
        @empty
            <div>No equipment has been added yet.</div>
        @endforelse
    
    </div>
    
</main>
@endsection