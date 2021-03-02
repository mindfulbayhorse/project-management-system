@section('title','Registration')
@include('show_err')

<x-master>
    <form name="authonticate" 
        method="POST" 
        action=""  
        class="registration">

        @csrf

        <div class="field">
            <label for="title">User email:</label>
            <input type="text" name="email" value="{{ old('email') }}" />
        </div> 	
  
        <div class="field">
            <label for="cost">Password:</label>
            <input type="password" name="password" value=""/>
        </div>
	            
        <div class="field">
            <label for="cost">Confirm password:</label>
            <input type="password" name="password_confirmation" value=""/>
        </div>
        
        <div class="field">
            <input type="submit" name="login" value="Sing in" />   
        </div>
    </form>
</x-master>