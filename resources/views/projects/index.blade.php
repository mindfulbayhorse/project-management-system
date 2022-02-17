<x-master>

    @section('title','List of projects')
    
    
    <a href="/projects/create" class="btn">Add project</a>
   @php
    $buttonText = isset($viewChoice[$currentView]) ? $viewChoice[$currentView] : 'By cards' 
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
    <main>
        <div class="projects_groups" 
            >
            @forelse ($projects as $project)
                    
    	       <x-projects.project.card :project="$project" />
            @empty
                <div>No projects have been added yet.</div>
    	    @endforelse
        
        </div>
        
    </main>

</x-master>