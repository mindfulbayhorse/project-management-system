@extends('layout')

@section('title','List of projects')

@section('content')

@include('show_err')

    <form name="authonticate" method="POST" action=""  class="groupped flex_block one_row row_wide">

        @csrf

	        <div class="flex_block one_column grid_rows">
	        
	            <div class="flex_block one_column">
	                <label for="title">User email:</label>
	                <input type="text" name="email" value="{{ old('email') }}" />
	            </div> 	
	            	        
	        </div>
	        
	        <div class="flex_block one_column grid_rows">
	            
	            <div class="flex_block one_column">
	                <label for="cost">Password:</label>
	                <input type="password" name="password" value=""/>
	            </div>
	            
	        </div>
	        
	         <div class="flex_block one_column grid_rows">
	            
	            <div class="flex_block one_column">
	        
	                <input type="submit" name="login" value="Sing in" />
	                
	            </div>
	            
	         </div>
    
    </form>
@endsection