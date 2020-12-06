@section('title','Create new project')

@extends('layout')

@section('content')
    <main>
    
        <form method="POST" 
        action="{{ route('equipment.update', $equipment) }}"
        class="equipment new">
        
        @include('show_err') 
        
        @include('equipment.form', [
            'equipment' => $equipment,
            'btnText' => 'Create'
        ])
        
    </form>
    
   </main>
   
@endsection