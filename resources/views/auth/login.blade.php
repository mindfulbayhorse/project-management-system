@extends('layout')

@section('title','Sign in')

@section('content')

	@include('show_err')

    <form name="authonticate" method="POST" class="login">

        @csrf
        
        <div class="field">

            <label for="title">User email:</label>
            <input type="text" name="email" value="{{ old('email') }}" />	        

	    </div>
	    
	    <div class="field">

            <label for="password">Password:</label>
            <input type="password" 
                name="password"
                id="password" 
                value=""/> 

	    </div>
        
        <div class="field">
            <input type="checkbox" 
                value="" 
                name="remember" 
                id="remember"/>
            <label for="cost">Remember</label>
        </div>
        
        <div class="field">
            <a href="/forgot-password">Forgot the password</a>
        </div>
	    
	     <div class="field_submit">
                <input type="submit" name="login" value="Sing in" />
    	 </div>
        
        <div class="field">
            <a href="/register">Don't have an account? Sign up</a>
        </div>
    </form>
@endsection