@extends('layouts.grid')

@section('title','Work breakdown structure')

@section('left_section')
    @include('show_err')
    
    <div class="wbs-section-panel">
        <a href="{{ route('projects.deliverables.create', $project) }}" 
            class="create_new">Add new deliverable</a> 

        @include('projects.activity.history')
    </div>
@endsection

@section('right_section')
    <main>
         <h1>@yield('title')</h1>
         @include('projects.wbs.table')
    </main> 

@endsection