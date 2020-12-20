@extends('equipment.show')

@section('info')
    
    <div class="project">
        <p><b>Name:</b>{{ $equipment->name }}</p>
   
    	<p><b>Type:</b>{{ $equipment->type }}</p>
    
    	<p><b>Model:</b>{{ $equipment->model}}</p>
        
        <p><b>Cost:</b>{{ $equipment->cost}}</p>
    
    	<a href="{{ $equipment->path() }}/edit" class="btn">Edit</a>
    </div>

@endsection
