@extends('layout')

@section('title','Create rss feed')

@section('content')
<nav>
    <a href="/rss/">Back</a>
</nav>
<main>

   @if ($errors->any())
       
       @foreach ($errors->all() as $text)
           <p>{{ $text }}</p>
       @endforeach
       
    @endif
    
    <form method="post" action="/rssfeed/">
        {{ csrf_field() }}
        <div>
            <label for="url">url: </label>
            <input type="txt" name="url" value="{{ old('url') }}"
                class="@if ($errors->has('url')) {{ 'incorrect' }} @endif"/>
        </div>
        <div>
            <label for="title">Title: </label>
            <input type="txt" name="title" value="{{ old('title') }}"
                class="{{ $errors->has('description') ? 'incorrect' : '' }}"/>
        </div>
        <div>
            <label for="description">Description: </label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>
  
  <input type="submit" name="save" value="Save"/>

</form>

</main>


@endsection
