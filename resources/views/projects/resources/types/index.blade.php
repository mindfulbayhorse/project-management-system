@extends('layout')

@section('title','List of resoucr types')

@section('content')

<main>
    
    @forelse ($types as $type)
    
        <p><a href="{{ $type->path('edit') }}">{{ $type->name}} </a></p>
    @empty
    
        There is no any resource types
        
    @endforelse
</main>
@endsection