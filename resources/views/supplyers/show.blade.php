@section('title','Edit supplyer')

@extends('layout')

@section('content')
    <main>
    
        <form method="POST" 
            action="/supplyers"
            class="supplyer">
        
            @include('show_err') 
            
            @include('supplyers.form', [
                'supplyer' => $supplyer,
                'btnText' => 'Save'
            ])
        
        </form>
    
   </main>
   
@endsection