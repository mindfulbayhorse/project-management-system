@section('title','Create new project')

@extends('layout')

@section('content')
    <main>
    
        <form method="POST" 
        action="/projects"
        class="project new">
        
        @include('show_err') 
        
        @include('projects.form', [
            'project' => new App\Models\Project,
            'btnText' => 'Create'
        ])
        
    </form>
    
   </main>
   
@endsection