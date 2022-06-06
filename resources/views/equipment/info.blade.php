@extends('equipment.show')

@section('info')
    
    <div class="project">
        
        <p><b>Model:</b>{{ $equipment->model}}</p>
        
    	<p><b>Type:</b>{{ $equipment->resource_type_id }}</p>

        <p><b>Manufacturer:</b>{{ $equipment->manufacturer }}</p>
        
        <p><b>Cost:</b>{{ $equipment->cost}}</p>
    
    	<a href="{{ $equipment->path() }}/edit" class="btn">Edit</a>
    </div>

@endsection
