<x-master>

    @section('title','List of projects')
    
    
    <a href="/projects/create" class="btn">Add project</a>
    <main>
        <div class="projects_groups">
            @forelse ($projects as $project)
                    
    	       <x-projects.project.card :project="$project" />
            @empty
                <div>No projects have been added yet.</div>
    	    @endforelse
        
        </div>
        
    </main>

</x-master>