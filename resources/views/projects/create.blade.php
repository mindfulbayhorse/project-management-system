@extends('layout')

@section('title','Create new project')

@section('content')

<main class='center_area'>
    <form method="POST" action="/projects" class="groupped flex_block one_row flex_width">
        @csrf
        
         <div class="flex_block grid_rows fld_space_20 around_space">
            
            <div class="flex_block one_column fld_space_100">
                <label for="title">Title:</label>
                <input type="text" name="title" value="{{ old('title') }}" />
            </div>
            
         </div>
         
          <div class="flex_block grid_rows fld_space_20 bottom_top_space">
            <div class="flex_block one_column fld_space_100">
                <label for="status_id">Status:</label>
                <select name="status_id">
                    <option value="">Choose</option>
                    @foreach ($statuses as $status)
                         <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>      
		</div>
		
		<div class="flex_block grid_rows fld_space_20 bottom_top_space">
            <div class="flex_block one_column">
                <label for="started">Start date:</label>
                <input type="text" value="{{ old('started') }}" name="started" />
            </div>
            
        </div>
        
        <div class="flex_block grid_rows fld_space_20 around_space">
        	<input type="submit" value="Create" name="create"/>
        </div>
    </form>

</main>
@endsection