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
        <div class="wide_screen flex_block one_row">
            <div class="left_nav">            
                @yield('left_sidebar')
            </div>
            <div class="right_main">            
                @yield('content')
            </div>
        </div>
        <script data-main="/multilevel_structure/js/main" src="/multilevel_structure/require.js?@php echo date('YmdHis'); @endphp""></script>
        <script>
        requirejs.config({
          urlArgs: "bust=" +  (new Date()).getTime()
        });
        </script>
    </body>
</html>
