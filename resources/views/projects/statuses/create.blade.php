@extends('layout')

@section('title','Create new status')

@section('content')

<main>
    <form method="POST" action="/statuses" class="status">
        @csrf 
        
        @include('projects.statuses.form', [
            'status' => new App\Status,
            'btnText' => 'Create'
        ])
         
    </form>

</main>
@endsection