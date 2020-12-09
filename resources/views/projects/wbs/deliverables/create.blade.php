@include('show_err')

<form id="deliverable" 
    name="deliverable" 
    method="POST" 
    action="{{ $wbs->project->path() }}/deliverables"
    class="deliverable new">

    <input type="hidden" name="wbs_id" value="{{ $wbs->id }}" />     
        @include('projects.wbs.deliverables.form',  [
                'deliverable' => new App\Models\Deliverable,
                'btnTitle' => 'Create'
        ])
</form> 
