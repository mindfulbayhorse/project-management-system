@extends('layout')

@section('title', $equipment->model)

@section('left_sidebar')
	 
@endsection

@section('content')
<main>
    @yield('info')
</main>
@endsection