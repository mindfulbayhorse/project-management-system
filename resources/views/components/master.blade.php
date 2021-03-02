<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}" />
<title>@yield('title','Laracast')</title>
</head>
<body>
	@include('blocks.header')
    {{ $slot }}
<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
