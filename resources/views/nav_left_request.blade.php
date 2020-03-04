<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WBS for edit</title>
<link rel="stylesheet" type="text/css" href="/css/normalize.css" />
<link rel="stylesheet/less" type="text/css" href="/less/rss_theme.less?@php echo date('YmdHis'); @endphp" />
<script>
          less = {
            env: "development",
            useFileCache: false
          };
        </script>
<script src="/less/less.js"></script>
<title>@yield('title','Laracast')</title>
</head>
<body>
	@include('header')
	<div class="wide_screen flex_block one_row">
		@hasSection('navigation')
			<div class="left_nav">@yield('left_sidebar')</div>
			<div class="right_main">
		@endif 
		
		<div class="center_part">            
            <h1>@yield('title')</h1>
            @yield('content')
        </div>
        
		@hasSection('navigation')
			</div>
		@endif
	</div>
</body>
</html>
