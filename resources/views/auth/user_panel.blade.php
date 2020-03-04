
@if (Route::has('login'))
    <div class="top-right links">
        @auth
           <form id="logout-form" action="{{ route('logout') }}" method="POST">
               @csrf
               <input class="btn_link" type="submit" value="Logout"/>
           </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
@endif