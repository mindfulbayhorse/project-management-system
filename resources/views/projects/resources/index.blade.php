@extends('layout')

@section('title', "Project's equipment")

@section('left_sidebar')
     @include('projects.dashboard') 
@endsection

@section('content')

<main>
    <a href="{{ $project->path() }}/resources/equipment/">Equipment</a>
    <p>Total: {{ $project->resources->count() }}</p>  
</main>
@endsection