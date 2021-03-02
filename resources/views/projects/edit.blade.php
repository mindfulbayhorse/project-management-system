@section('title','Edit project')

@extends('projects.show')

@section('indicators')

    @include('show_err') 
 
    <div class='actions'>
        
        <form method="POST" 
            action="{{ $project->path() }}"
            class="project">
         
            @method('PATCH')
          
            @include('projects.form', ['btnText' => 'Save'] )
        
        </form>
        
        <x-projects.delete-project-button :project="$project"></x-delete-project-button>

    
    </div>
  

@endsection