@extends('layout')

@section('title', $equipment->name)

@section('left_sidebar')
	 
@endsection

@section('content')
<main>
    @yield('info')
</main>
@endsection