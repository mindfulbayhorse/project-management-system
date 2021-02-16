@section('title','Add new supplier')

@extends('layout')

@section('content')
    <main>
    
        <form method="POST" 
            action="/suppliers"
            class="supplier new">
        
            @include('show_err') 
            
            @include('suppliers.form', [
                'supplier' => new App\Models\Supplier,
                'btnText' => 'Add'
            ])
        
        </form>
    
   </main>
   
@endsection