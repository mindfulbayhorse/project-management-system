<nav class="tree">
	<ul data-template="treeLevels">
		@foreach ($project->deliverables as $del_tree)
			@if (isset($deliverable))
        	
    			@if ($del_tree->parent_id === $deliverable->parent_id)
            		<li>
            			<a href="/projects/{{$project->id}}/wbs/{{$deliverable->id}}">{{$del_tree->title}}</a>
            		</li>
        		@endif
        	@endif
        @endforeach
    </ul>
</nav>

