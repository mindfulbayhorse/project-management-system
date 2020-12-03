@extends('layout')

@section('title','Add new candidate')

@section('content')

<main class='center_area'>

   @if ($section)
    @include('blocks.breadcrumbs', compact('section'))
   @endif
   
   @include('show_err')
   
   <form method="POST" 
        action="{{ $candidate->path() }}"
        class="candidate">
        
        @method('PATCH')
       
        @include('candidates.form', [
            'candidate' => $candidate,
            'btnText' => 'Create'
        ])
        
    </form>
  
</main>
@endsection