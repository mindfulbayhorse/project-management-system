@extends('layout')

@section('title','Add new candidate')

@if ($section)
    @include('blocks.breadcrumbs', compact('section'))
@endif

@section('content')

<main class='center_area'>

   
   
   <form method="POST" 
        action="/candidates"
        class="candidate">
        
        @include('show_err') 
        
        @include('candidates.form', [
            'candidate' => new App\Models\User,
            'btnText' => 'Create'
        ])
        
    </form>
  
</main>
@endsection