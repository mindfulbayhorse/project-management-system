<x-master>
    <div class="wide_screen dashboard">
        @auth ve
            @hasSection('left_sidebar')
                @yield('left_sidebar') 
            @else 
                @include('blocks.primary_menu')
            @endif
        @endauth
        <div class="center_part">
            @yield('breadcrumbs')
            
            <h1>@yield('title')</h1>
        
            {{ $slot }}
            
        </div>

    </div>
</x-master>