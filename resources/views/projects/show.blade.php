@extends('layout')

@section('title', $project->title)

@section('left_sidebar')
	 @include('projects.dashboard') 
@endsection

@section('content')
<main>
    @yield('indicators')
</main>
@endsection