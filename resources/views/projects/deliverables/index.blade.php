@extends('nav_left')

@section('title','Work breakdown structure')

@section('left_sidebar')
<h2>{{$project->title}}</h2>
<h3>Work breakdown structure</h3>
<nav>
  <ul>
      <li></li>
  </ul>
</nav>
@endsection

@section('content')
    @include('projects.deliverables.sub_create')
    @include('projects.deliverables.sub_table')
@endsection