@extends('layouts.two_columns')

@section('title','Edit deliverable')

@section('left_section')
    <main>
        @include('projects.wbs.deliverables.info')
    </main>
@endsection

@section('right_section')
   
     @include('projects.wbs.deliverables.table')
@endsection