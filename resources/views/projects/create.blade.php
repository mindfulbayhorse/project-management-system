@extends('layout')

@section('title','Create new project')

@section('content')

<main class='center_area'>
   
   <form method="POST" 
        action="/projects"
        class="project">
        
        @include('show_err') 
        
        @include('projects.form', [
            'project' => new App\Project,
            'btnText' => 'Create'
        ])
        
    </form>
  
</main>
@endsection