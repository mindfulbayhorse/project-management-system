<x-master>

    @section('title', $project->title)
    
    @section('left_sidebar')
    	 @include('projects.dashboard') 
    @endsection
    

    <main>
        @yield('indicators')
    </main>

</x-master>