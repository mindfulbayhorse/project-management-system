@extends('layout')

@section('title','List of section titles')

@if ($section)
    @include('blocks.breadcrumbs', compact('section'))
@endif
   
@section('content')
test
<a href="{{ route('sections.create') }}" class="btn">Add section title</a>
<main>
    <ul class="candidates_list">
        @forelse ($sections as $section)
            <li>
                <a href="{{ route('sections.edit', $section->id) }}">{{ $section->code }}, 
                    {{ $section->title }}</a>
            </li>
        @empty
            <div>No section has had title yet.</div>
        @endforelse
    
    </div>
    
</main>
@endsection