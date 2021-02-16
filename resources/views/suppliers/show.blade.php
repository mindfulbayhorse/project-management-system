@section('title','Edit supplier')

@extends('layout')

@section('content')
    <main>
    
        <form method="POST" 
            action="{{ $supplier->path() }}"
            class="supplier">
            
            @method('PATCH')
        
            @include('show_err') 
            
            @include('suppliers.form', [
                'supplier' => $supplier,
                'btnText' => 'Save'
            ])
        
        </form>
        <form method="POST"
            action="{{ $supplier->path() }}">
            
            @csrf
            @method('DELETE')
            
            <input type="submit" value="Delete" name="delete" />    
        </form>
    
   </main>
   
@endsection