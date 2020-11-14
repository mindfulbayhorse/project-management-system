@extends('layout')

@section('title','Edit project')

@section('left_sidebar')

<section class="project_dashboard">
    <a href="{{$project->path()}}/wbs">Work breakdown structure</a>
    <a href="{{$project->path()}}/team">Team</a>
</section>

@endsection

@section('content')

<main class='center_part'>

    @include('show_err') 
    
    <form method="POST" 
        action="{{ $project->path() }}"
        class="project">
     
        @method('PATCH')
      
        @include('projects.form', ['btnText' => 'Save'] )
    
    </form>
    
    <form action="{{ $project->path() }}" 
        method="POST"
        >
    
        @csrf 
        @method('DELETE')
        
        <input 
            type="submit" 
            value="Delete" 
            class="delete"
            name='delete' />
        
    </form>
    
</main>

@endsection