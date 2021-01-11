@section('title','Add new equipment')

@extends('layout')

@section('content')
    <main>
    
        <form method="POST" 
        action="{{ route('equipment.index') }}"
        class="equipment new">
        
        @include('show_err') 
        
        @include('equipment.form', [
            'equipment' => new App\Models\Equipment,
            'btnText' => 'Create'
        ])
        
    </form>
    
   </main>
   
@endsection