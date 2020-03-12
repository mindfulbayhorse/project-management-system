<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
	@include('blocks.header')
	<div class="wide_screen flex_block one_row">
		@hasSection('left_sidebar')
			<div class="left_nav">
				<div class="section_title">
					<h2>@yield('section_title')</h2>
					<h1>@yield('title')</h1>
				</div>
				@yield('left_sidebar')
			</div>
			<div class="right_main">
				<div class="center_area">
		@else
			<div class="center_part">
				<h1>@yield('title')</h1>
		@endif
		
		@yield('content')
			
		@hasSection('left_sidebar')
			</div>
		@endif
				
		</div>

	</div>
@php 
if (!preg_match('/wbs/', $_SERVER['REQUEST_URI'])){
@endphp
<script data-main="/multilevel_structure/js/main" src="/multilevel_structure/require.js?@php echo date('YmdHis'); @endphp"></script>
<script>
requirejs.config({
  urlArgs: "bust=" +  (new Date()).getTime()
});
</script>
@php 
}
@endphp
</body>
</html>
