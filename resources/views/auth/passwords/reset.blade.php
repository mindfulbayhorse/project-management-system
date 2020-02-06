@extends('layout')

@section('title','List of projects')

@section('content')

@include('show_err')

    <form name="authonticate" method="POST" action="/password/reset"  class="groupped flex_block row_wide">

        @csrf
        <input type="hidden" name="token" value="{{ $token }}" /> 
        
	        <div class="flex_block fld_space_100">
	        
	            <div class="flex_block one_column  one_column fld_space_50_left"">
	                <label for="title">User email:</label>
	                <input type="text" name="email" value="{{ $email }}" />
	            </div> 	
	            	        
	        </div>
	        
	        <div class="flex_block fld_space_100">
	        
	            <div class="flex_block one_column  one_column fld_space_50_left"">
	                <label for="title">New password:</label>
	                <input type="password" name="password" value="" />
	            </div> 	
	            	        
	        </div>
	        
	        <div class="flex_block fld_space_100">
	        
	            <div class="flex_block one_column  one_column fld_space_50_left"">
	                <label for="title">Password confirmation:</label>
	                <input type="password" name="password_confirmation" value="" />
	            </div> 	
	            	        
	        </div>
	        
	        <div class="flex_block fld_space_100">	
	            <input type="submit" name="send" value="Send link" />	        
	        </div>
    
    </form>
@endsection