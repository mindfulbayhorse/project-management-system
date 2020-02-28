@extends('layout')

@section('title','Edit a project')

@section('content')

<main>
    
    @include('show_err') 
    
    <form method="POST" action="/projects/{{ $project->id }}">
    
        @csrf 
        @method('PATCH')
        
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ $project->title }}" />
        </div>
        
        <div>
            <label for="status">Status:</label>
            <select name="status">
                <option value="0" @if ($project->status === '0')) {{ 'selected' }} @endif>Select a status</option>
                <option value="1" @if ($project->status === '1')) {{ 'selected' }} @endif>Active</option>
                <option value="2" @if ($project->status === '2')) {{ 'selected' }} @endif>Deployment</option>
                <option value="3" @if ($project->status === '3')) {{ 'selected' }} @endif>Closed</option>
            </select>
        </div>  
        
        <div>
            <label for="started">Start date:</label>
            <input type="text" name="started" value="{{ $project->started }} " />
        </div>   
    
        <input type="submit" class="btn" value="Save" name="save"/>
    </form>
    
    <form action="/projects/{{ $project->id }}" method="POST">
    
        @csrf 
        @method('DELETE')
        
        <input type="submit" class="btn" value="Delete" name='delete' />
        
    </form>
    
    <a href="/projects/{{$project->id}}/wbs">Work breakdown structure</a>
    
</main>
@endsection