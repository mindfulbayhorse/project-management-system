@extends('layout')

@section('title','Edit status')

@section('content')


@if (session()->has('success'))
    {{ session()->get('success') }}
@endif
<main>
    <form method="POST" action="{{$status->path()}}" class="status">
        @method('PATCH')
        @csrf 
        
        @include('projects.statuses.form', [
            'btnText' => 'Save'
        ])
         
    </form>

</main>
@endsection