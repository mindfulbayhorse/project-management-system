@extends('layout')

@section('title','Create new status')

@section('content')

<main>
    <form method="POST" action="/statuses">
        @csrf 
        
        <div class="flex_block grid_rows">
        
            <div class="flex_block one_column col_half">
            	<label for="title">Title:</label>
            	<input type="text" name="name" value="{{ old('name') }}" />
            </div>
        </div>
        
        <div class="flex_block grid_rows">   
            <div class="flex_block one_column col_half">
                <label for="title">Description:</label>
                <textarea name="description">{{ old('description') }}</textarea>
            </div>
        
        </div>

        <input type="submit" value="Create" name="create"/>
    </form>

</main>
@endsection