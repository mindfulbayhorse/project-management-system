<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}" />
<title>@yield('title','Laracast')</title>
</head>
<body>
	@include('blocks.header')
    
    @yield('breadcrumbs')
            
    @yield('last_project')
            
	<div class="wide_screen dashboard">
        @auth
            @hasSection('left_sidebar')
                @yield('left_sidebar') 
            @else 
                @include('blocks.primary_menu')
            @endif
        @endauth
        <div class="center_part">
            
			<h1>@yield('title')</h1>
		
		      @yield('content')
		</div>

	</div>
<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
