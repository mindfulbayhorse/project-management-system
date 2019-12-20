@extends('layout')

@section('title','Create new project')

@section('content')

<main>
    <form method="POST" action="/projects">
        @csrf 
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" />
        </div>
        
        <div>
            <label for="status">Status:</label>
            <select name="status">
                <option value="0">Select a status</option>
                <option value="1">Active</option>
                <option value="2">Deployment</option>
                <option value="3">Closed</option>
            </select>
        </div>      
    
        <div>
            <label for="started">Start date:</label>
            <input type="text" value="" name="started" />
        </div>
        
        <input type="submit" class="btn" value="Create" name="create"/>
    </form>

</main>
@endsection