@extends('layout')

@section('title','Project team')

@section('content')

<main class='center_area'>
   
   <form method="POST" 
        action="{{ $project->path() }}/team"
        class="project team">
        
        @include('show_err') 
        
        @include('projects.team.form', [
            'btnText' => 'Add member'
        ])
        
    </form>
  
</main>
@endsection