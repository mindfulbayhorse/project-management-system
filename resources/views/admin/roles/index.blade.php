@extends('layout')

@section('title','List of section titles')

@if ($section)
    @include('blocks.breadcrumbs', compact('section'))
@endif
   
@section('content')

<a href="{{ route('roles.create') }}" class="btn">Add new role</a>
<main>
    <ul>
        @forelse ($roles as $role)
            <li>
                <a href="{{ route('roles.edit', $role->id) }}">{{ $role->name }}, 
                    {{ $role->label }}</a>
            </li>
        @empty
            <div>No roles have been created yet.</div>
        @endforelse
    
    </div>
    
</main>
@endsection