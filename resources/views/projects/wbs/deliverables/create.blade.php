@extends('layouts.grid')

@section('title','Create new deliverable')

@section('left_section')

    @include('show_err')
    
    <form id="deliverable" 
        name="deliverable" 
        method="POST" 
        action="{{ $project->path() }}/deliverables"
        class="deliverable new">
    
        <input type="hidden" name="wbs_id" value="{{ $wbs->id }}" />     
            @include('projects.wbs.deliverables.form',  [
                    'deliverable' => new App\Models\Deliverable,
                    'btnTitle' => 'Create'
            ])
    </form>
@endsection

@section('right_section')

    <fieldset>
        <legend>Arrange order</legend>
        <div class="order_choice">
            <div class="">
              <input
                type="radio" 
                value="" 
                form="deliverbale" 
                id="last"
                name="order_choice" >
              <label class="form-check-label" for="last">
                Insert first
              </label>
            </div>
            <div class="">
              <input
                type="radio" 
                value="" 
                form="deliverbale" 
                id="last"
                name="order_choice" >
              <label class="form-check-label" for="last">
                Insert last
              </label>
            </div>
            <div class="">
              <input
                type="radio" 
                value="" 
                form="deliverbale" 
                id="last"
                name="order_choice" >
              <label class="form-check-label" for="last">
                Insert next to:
              </label>
            </div>
        </div>
        
        @include('projects.wbs.table',  [
                'form' => 'deliverable',
        ])
    </fieldset>
    
            
@endsection
