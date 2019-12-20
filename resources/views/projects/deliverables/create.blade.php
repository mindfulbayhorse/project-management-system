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
<main>
    <form method="POST" action="/projects/{{$project->id}}/deliverables">
        @csrf
        
        <input type="hidden" name="project_id" value="{{$project->id}}" /> 
        <div class="flex_block one_row">
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" />
        </div>
        
        <div class="flex_block one_row">
            <label for="cost">Cost:</label>
            <input type="text" value="" name="cost" />
        </div>   
    
        <div class="flex_block one_row">
            <label for="started">Start date:</label>
            <input type="text" value="" name="start_date" />
        </div>
        
        <div class="flex_block one_row">
            <label for="started">End date:</label>
            <input type="text" value="" name="end_date" />
        </div>
        
        <input type="submit" class="btn" value="Create" name="create"/>
    </form>

</main>
@endsection