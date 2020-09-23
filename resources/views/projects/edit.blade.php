@extends('layout')

@section('title','Edit a project')

@section('content')

<main>
    
    @include('show_err') 
    
    <form method="POST" 
        action="{{$project->path() }}"
    	class="groupped flex_block one_row flex_width">
    
        @csrf
        @method('PATCH')
        
        <div class="flex_block grid_rows fld_space_30 around_space">
        	<div class="flex_block one_column fld_space_100">
            	<label for="title">Title:</label>
            	<input type="text" name="title" value="{{ $project->title }}" />
            </div>
        </div>
        
         <div class="flex_block grid_rows fld_space_30 bottom_top_space">
         	<div class="flex_block one_column fld_space_100">
                <label for="status">Status:</label>
                <select name="status">
                    <option value="0" @if ($project->status === '0')) {{ 'selected' }} @endif>Select a status</option>
                    
                    @foreach ($statuses as $status)
                    	<option value="{{ $status['id'] }}" 
                    		@if ($project->status_id === $status['id'])) 
                    			{{ 'selected' }}
                    		@endif
                    		>{{$status['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="flex_block grid_rows fld_space_30 bottom_top_space">
        	<div class="flex_block one_column fld_space_100">
            	<label for="started">Start date:</label>
            	<input type="text" name="started" value="{{ $project->started }} " />
        	</div>
        </div>
    
    	<div class="flex_block grid_rows fld_space_30 around_space">
        	<input type="submit" class="btn" value="Save" name="save"/>
        </div>
    </form>
    
    <form action="/projects/{{ $project->id }}" method="POST">
    
        @csrf 
        @method('DELETE')
        
        <input type="submit" class="btn" value="Delete" name='delete' />
        
    </form>
    
    <a href="/projects/{{$project->id}}/wbs">Work breakdown structure</a>
    
</main>
@endsection