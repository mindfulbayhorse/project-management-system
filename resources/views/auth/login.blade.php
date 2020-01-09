@extends('layout')

@section('title','List of projects')

@section('content')

@include('show_err')

    <form name="authonticate" method="POST" action=""  class="groupped flex_block one_row">

        @csrf

	        <div class="flex_block one_column grid_rows col_1">
	        
	            <div class="flex_block one_column">
	                <label for="title">User name:</label>
	                <input type="text" name="username" value="{{ old('username') }}" />
	            </div> 	
	            	        
	        </div>
	        
	        <div class="flex_block one_column grid_rows col_2">
	            
	            <div class="flex_block one_column">
	                <label for="cost">Password:</label>
	                <input type="password" name="password" value="{{ old('password') }}"/>
	            </div>
	            
	        </div>
	        
	         <div class="flex_block one_column grid_rows col_2">
	            
	            <div class="flex_block one_column">
	        
	                <input type="submit" name="login" value="Sing in" />
	                
	            </div>
	            
	         </div>
    
    </form>
@endsection