@extends('layout')

@section('title','List of projects')

@section('content')

@include('show_err')

    <form name="authonticate" method="POST" class="groupped flex_block one_row row_wide">

        @csrf

	        <div class="flex_block grid_rows">
                <label for="title">User email:</label>
                <input type="text" name="email" value="{{ old('email') }}" />	        
	        </div>
	        
	        <div class="flex_block grid_rows">
                <label for="cost">Password:</label>
                <input type="password" name="password" value=""/> 
	        </div>
	        
	         <div class="flex_block grid_rows">
                <input type="submit" name="login" value="Sing in" />
	         </div>
    
    </form>
@endsection