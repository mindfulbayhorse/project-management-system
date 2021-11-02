@extends('layout')

@section('content')

    <h1>{{ $role->label }}</h1>
    
    <p>System name: {{ $role->name }}</p>


@endsection