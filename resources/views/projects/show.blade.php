@extends('layout')

@section('title','Project indicators')

@section('left_sidebar')
	 @include('projects.dashboard') 
@endsection

@section('content')
<main>
    @yield('indicators')
</main>
@endsection