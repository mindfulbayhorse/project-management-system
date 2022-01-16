<x-master>

    @section('title','List of projects')
    
    
    <a href="/projects/create" class="btn">Add project</a>
    <div x-data="{ 
        open: false,
        toggle() { this.open =  this.open ? this.close() : true },
        close(focusAfter) { 
            this.open = false 
            focusAfter && focusAfter.focus()
       }
    }" 
    [x-id]="['type-view']"
    @keydown.escape.prevent.stop = "close($refs.button)"
    @focusin.window = "! $refs.panel.contains($event.target) && close()"
    class="dropdown">
        <button 
            x-ref="button"
            @click="toggle()"
            :aria-expanded = "open"
            :aria-controls = "$id('type-view')"
            type="button">
            <span>Show by</span><span class="icon"></span>
        </button>
        <div class="list" 
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            @click.outside = "close($refs.button)"
            style="display: none;"
            :id="$id('type-view')">
            <a href="{{ route('projects.index') }}?showby=cards">Cards</a>
            <a href="{{ route('projects.index') }}?showby=table">Table</a>
        </div>
    </div>
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