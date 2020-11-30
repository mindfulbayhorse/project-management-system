@extends('layout')

@section('title','Add new candidate')

@section('content')

<main class='center_area'>
   
   @include('show_err')
   
   <form method="POST" 
        action="/candidates"
        class="candidate">
        
        <input type="hidden"
            value="{{ $candidate->id }}" />
        
        
        
        @include('candidates.form', [
            'candidate' => $candidate,
            'btnText' => 'Create'
        ])
        
    </form>
  
</main>
@endsection