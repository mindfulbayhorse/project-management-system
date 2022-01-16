<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}" />
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<title>@yield('title','Laracast')</title>
</head>
<body>
	<div id="top_slogan" class="@if (Auth::check()) shortcut @endif">
        <a href="/" class="title">Project management system</a>
        <div class="user_profile">
        	@include('auth.user_panel')
        </div>
    </div>
    
   <div class="wide_screen dashboard">
        @auth
            @hasSection('left_sidebar')
                @yield('left_sidebar') 
            @else 
                @include('blocks.primary_menu')
            @endif
        @endauth
        <div class="center_part">

            @auth
                @yield('breadcrumbs')
                @widget("App\Http\Widgets\LastSeenProject")
                <h1>@yield('title')</h1>
            @endauth
        
            {{ $slot }}
            
        </div>

    </div>
<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
