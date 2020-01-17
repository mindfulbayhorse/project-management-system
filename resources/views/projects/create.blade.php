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
            <label for="status_id">Status:</label>
            <select name="status_id">
                <option value="">Choose</option>
                @foreach ($statuses as $status)
                     <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
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