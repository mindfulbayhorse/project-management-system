@section('title','Edit supplyer')

@extends('layout')

@section('content')
    <main>
    
        <form method="POST" 
            action="{{ $supplyer->path() }}"
            class="supplyer">
            
            @method('PATCH')
        
            @include('show_err') 
            
            @include('supplyers.form', [
                'supplyer' => $supplyer,
                'btnText' => 'Save'
            ])
        
        </form>
        <form method="POST"
            action="{{ $supplyer->path() }}">
            
            @csrf
            @method('DELETE')
            
            <input type="submit" value="Delete" name="delete" />    
        </form>
    
   </main>
   
@endsection