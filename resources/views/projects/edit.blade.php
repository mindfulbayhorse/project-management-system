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
        
        <form action="{{ $project->path() }}" method="POST">
        
            @csrf 
            @method('DELETE')
            
            <input type="submit" 
                value="Delete" 
                class="delete"
                name='delete' />
            
        </form>
    
    </div>
  

@endsection