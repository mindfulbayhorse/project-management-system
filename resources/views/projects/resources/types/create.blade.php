@extends('layout')

@section('title','Create new resource type')

@section('content')

<main>
    <form method="POST" action="/resources_types" class="status">
        @csrf 
        
        @include('projects.resources.types.form', [
            'type' => new App\Models\ResourceType,
            'btnText' => 'Create'
        ])
         
    </form>

</main>
@endsection