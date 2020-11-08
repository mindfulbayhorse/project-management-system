@extends('layout')

@section('title','New deliverable')

@section('content')

<main>
     <form id="deliverable" 
        name="deliverable" 
        method="POST" 
    	action="{{ $project->path() }}/wbs"
        class="deliverable new"
      >
        
        @include('projects.wbs.deliverables.form',  [
            'deliverable' => new App\Models\Deliverable,
            'btnTitle' => 'Create'
        ])
        
    </form>

</main>
@endsection