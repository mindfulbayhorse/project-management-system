@extends('layouts.three_columns')

@section('title','Work breakdown structure')

@section('left_section')

    @include('projects.wbs.deliverables.create')
    
@endsection

@section('center_section')
    <main>
         <h1>@yield('title')</h1>
         @include('projects.wbs.table')
    </main> 

@endsection

@section('right_sidebar')

          @include('projects.activity.history') 

@endsection