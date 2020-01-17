@extends('layout')

@section('title','Create new status')

@section('content')

<main>
    <form method="POST" action="/statuses">
        @csrf 
        <div>
            <label for="title">Title:</label>
            <input type="text" name="name" value="{{ old('name') }}" />
        </div>
        
        <div>
            <label for="title">Description:</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>
        
        <input type="submit" class="btn" value="Create" name="create"/>
    </form>

</main>
@endsection