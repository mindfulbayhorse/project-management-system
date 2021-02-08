@section('title','Add new supplyer')

@extends('layout')

@section('content')
    <main>
    
        <form method="POST" 
            action="/supplyers"
            class="supplyer new">
        
            @include('show_err') 
            
            @include('supplyers.form', [
                'supplyer' => new App\Models\Supplyer,
                'btnText' => 'Add'
            ])
        
        </form>
    
   </main>
   
@endsection