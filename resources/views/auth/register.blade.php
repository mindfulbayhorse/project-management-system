@extends('layout')

@section('title','List of projects')

@section('content')

@include('show_err')

    <form name="authonticate" method="POST" action=""  class="groupped flex_block one_row">

        @csrf

	        <div class="flex_block one_column grid_rows col_1">
	        
	            <div class="flex_block one_column">
	                <label for="title">User name:</label>
	                <input type="text" name="name" value="{{ old('name') }}" />
	            </div> 	
	            	        
	        </div>
	        
	        <div class="flex_block one_column grid_rows col_1">
	        
	            <div class="flex_block one_column">
	                <label for="title">User email:</label>
	                <input type="text" name="email" value="{{ old('email') }}" />
	            </div> 	
	            	        
	        </div>
	        
	        <div class="flex_block one_column grid_rows col_2">
	            
	            <div class="flex_block one_column">
	                <label for="cost">Password:</label>
	                <input type="password" name="password" value=""/>
	            </div>
	            
	        </div>
	        
	          <div class="flex_block one_column grid_rows col_2">
	            
	            <div class="flex_block one_column">
	                <label for="cost">Confirm password:</label>
	                <input type="password" name="password_confirmation" value=""/>
	            </div>
	            
	        </div>
	        
	         <div class="flex_block one_column grid_rows col_2">
	            
	            <div class="flex_block one_column">
	        
	                <input type="submit" name="login" value="Sing in" />
	                
	            </div>
	            
	         </div>
    
    </form>
@endsection