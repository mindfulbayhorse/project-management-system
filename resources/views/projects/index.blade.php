<x-master>

    @section('title','List of projects')

        <a href="/projects/create" class="btn">Add project</a>
           @php
            $buttonText = isset($viewChoice[$currentView]) ? $viewChoice[$currentView] : 'By cards';
           @endphp
    
        <x-forms.dropdown.dropdown :id="'type_view'" :buttonText="$buttonText">
        @foreach($viewChoice as $name => $view)
           @if (isset($currentView) && $name !== $currentView)
            @php
                $link = route('projects.index',[], false).'?showby='.$name
            @endphp
            <x-forms.dropdown.item 
                href="{{ $link }}" 
                :selected="request()->is($link)">{{ $view }}</x-forms.dropdown-item>
           @endif
        @endforeach
    </x-forms.dropdown>
    
    <x-status-dropdown-list />
   
   <form method="GET" style="display: flex;" action="">        
        
              
        @if (request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}" /> 
        @endif
        
        <div>
            <label for="search_title">Title:</label>
            <input type="text" value="{{ request('title') }}" name="title" />
        </div>
  
        
    </form>
    
    <main>
        <div class="projects_groups">
            @forelse ($projects as $project)
                    
    	       <x-projects.project.card :project="$project" />
               
            @empty
                <div>No projects have been added yet.</div>
    	    @endforelse
        
            @if ($projects)
                <div>{{ $projects->links() }}</div>
            @endif
        </div>
        
    </main>

</x-master>