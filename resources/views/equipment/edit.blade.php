@section('title','Edit equipment')

@extends('layout')

@section('content')
    <main>
    
         @include('show_err') 
    
        <form method="POST" 
            action="{{ route('equipment.update', $equipment) }}"
            class="equipment new">
            
            @method('PATCH')
            
            @include('equipment.form', [
                'equipment' => $equipment,
                'btnText' => 'Update'
            ])
        
    </form>
    
   </main>
   
@endsection