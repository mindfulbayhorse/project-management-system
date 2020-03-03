@extends('layout')

@section('title','List of projects')

@section('content')

    <p>This is form to sign in.</p>

	@include('show_err')

    <form name="authonticate" method="POST" class="groupped center_area">

        @csrf
        
        <div class="flex_block grid_rows around_space">

	        <div class="flex_block one_column fld_space_100 bottom_space">
                <label for="title">User email:</label>
                <input type="text" name="email" value="{{ old('email') }}" />	        
	        </div>
	    </div>
	    
	    <div class="flex_block grid_rows around_space">
	        <div class="flex_block one_column fld_space_100 bottom_space">
                <label for="cost">Password:</label>
                <input type="password" name="password" value=""/> 
	        </div>
	    </div>
	    
	     <div class="flex_block grid_rows bottom_space">
	         <div class="flex_block grid_rows">
                <input type="submit" name="login" value="Sing in" />
	         </div>
    	</div>
    </form>
@endsection