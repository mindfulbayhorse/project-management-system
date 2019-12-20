<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/css/normalize.css" />
        <link rel="stylesheet/less" type="text/css" href="/less/rss_theme.less" />
        <script>
          less = {
            env: "development",
            useFileCache: false
          };
        </script>
        <script src="/less/less.js" ></script>
        <title>@yield('title','Laracast')</title>

        
    </head>
    <body>
        <div id="top_slogan">
            <p class="title">Project performance</p>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
        </div>
        <div class="center_part">            
            <h1>@yield('title')</h1>
            @yield('content')
        </div>
    </body>
</html>
