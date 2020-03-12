@if (isset($deliverable))
	@include('projects.wbs.deliverable.info')
@endif

@include('projects.wbs.deliverable.create')

@include('projects.wbs.deliverable.table') 
