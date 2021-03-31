@extends('layout')

@section('title','Edit resource type')

@section('content')

<main>
    <form method="POST" action="/resources_types">
    
        @method('PATCH')
        
        @include('projects.resources.types.form', [
            'type' => $type,
            'btnText' => 'Update'
        ])
         
    </form>

</main>
@endsection