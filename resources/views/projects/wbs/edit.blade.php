@extends('layouts.grid')

@section('title','Work breakdown structure')

@section('left_section')
    <main>
        @include('show_err') 
        <div class="wbs-section-panel">
            <a href="" 
                class="">Add new deliverable</a> 

            @include('projects.activity.history')
        </div>
@endsection

@section('right_section')
    <main>
         <h1>Work breakdown structure</h1>
         @include('projects.wbs.table')
    </main> 

@endsection