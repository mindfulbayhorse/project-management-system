@extends('layout')

@section('title','Equipment')

@section('content')
<a href="{{ route('equipment.create') }}" class="btn">Add equipment</a>
<main>
    <div class="panel">
        <div class="search">
            <form>
                <label>Model:</label>
                <input type="text" value="" name="search" />
                <input type="submit" value="Search" />
                <input type="reset" value="Reset" />
            </form>
       
        </div>
    </div>
    <div class="equipment_groups">
        @forelse ($equipment as $item)
                
            <div class="card">
                <a href="{{ $item->path() }}" 
                    class="title">{{ $item->model }}</a>
                <div class="card-body">
                    <div class="card-text">
                        <p>{{ $item->type }}</p>
                        <p>{{ $item->manufacturer }}</p>
                    </div>                   
                </div>
            </div>
        @empty
            <div>No equipment has been added yet.</div>
        @endforelse
    
    </div>
    
    {{ $equipment->links('vendor.pagination.default') }}
    
</main>
@endsection