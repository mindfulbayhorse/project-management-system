@extends('layout')

@section('title','Create new work unit')

@section('content')

<main>
	 @include('show_err')
    <form method="POST" action="/work_units" class="groupped flex_block one_row flex_width">
        @csrf 
        
         <div class="flex_block grid_rows fld_space_30 around_space">
        
             <div class="flex_block one_column fld_space_100">
            	<label for="title">Title:</label>
            	<input type="text" name="name" value="{{ old('name') }}" />
            </div>
        </div>
        
        <div class="flex_block grid_rows fld_space_30 bottom_top_space">
             <div class="flex_block one_column fld_space_100">
                <label for="title">Description:</label>
                <textarea name="description">{{ old('description') }}</textarea>
            </div>
        
        </div>

		<div class="flex_block grid_rows fld_space_30 bottom_space">
        	<input type="submit" value="Create" name="create"/>
        </div>
    </form>

</main>
@endsection