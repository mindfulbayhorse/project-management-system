@extends('layouts.two_columns')

@section('title','Edit deliverable')

@section('left_section')

    <h1>@yield('title')</h1>

    @include('show_err') 
     
    <form id="deliverable" 
        name="deliverable" 
        method="POST" 
        action="{{ $deliverable->path() }}"
        class="deliverable new">
    
        @method('PATCH')
        
        <input type="hidden" name="id" value="{{$deliverable->id}}" />
        <input type="hidden" name="wbs_id" value="{{$deliverable->wbs->id}}" />
        
        @include('projects.wbs.deliverables.form',  [
                'btnTitle' => 'Save'
         ])
    
    </form>
    
@endsection

@section('right_section')
   <x-projects.wbs.deliverable.order>
        @include('projects.wbs.deliverables.table',  [
                'form' => 'deliverable',
        ])
   </x-projects.wbs.deliverable.order>
@endsection