@extends('layout')

@section('title','Password reset link')

@section('content')

@include('show_err')

    <form name="authonticate" method="POST" action="/forgot-password"  
    class="email_link">

        @csrf

	        <div class="flex_block one_column grid_rows col_1">
	        
	            <div class="flex_block one_column">
	                <label for="title">User email:</label>
	                <input type="text" name="email" value="{{ old('email') }}" />
	            </div> 	
	            	        
	        </div>
	        
	        <div class="flex_block one_column grid_rows col_1">	
	            <input type="submit" name="send" value="Send link" />	        
	        </div>
    
    </form>
@endsection