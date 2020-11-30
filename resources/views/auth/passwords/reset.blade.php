@extends('layout')

@section('title','Reset password')

@section('content')

@include('show_err')

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form name="authonticate" method="POST" action="/reset-password"  
        class="reset_password">

        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}" /> 
        
	        <div class="flex_block fld_space_100">
	        
	            <div class="flex_block one_column  one_column fld_space_50_left"">
	                <label for="title">User email:</label>
	                <input type="text" name="email" value="{{ old('email', $request->email) }}" />
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