@extends('layout')

@section('title','Create new project')

@section('content')

<main>
    <form method="POST" action="/projects">
        @csrf 
        
        <div class="flex_block one_column grid_rows col_1">
            
            <div class="flex_block one_column">
                <label for="title">Title:</label>
                <input type="text" name="title" value="{{ old('title') }}" />
            </div>
            
            <div class="flex_block one_column">
                <label for="status_id">Status:</label>
                <select name="status_id">
                    <option value="">Choose</option>
                    @foreach ($statuses as $status)
                         <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>      
        
            <div class="flex_block one_column">
                <label for="started">Start date:</label>
                <input type="text" value="" name="started" />
            </div>
            
        </div>
        
        <input type="submit" value="Create" name="create"/>
    </form>

</main>
@endsection