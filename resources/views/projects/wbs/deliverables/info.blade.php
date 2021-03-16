<div class="deliverable summary">
	
	<h1>{{$deliverable->title}}</h1>
		
	<div>
        <p>Start date: {{$deliverable->start_date}}</p>
    </div>
		
	<div>
		<p>End date: {{$deliverable->end_date}}</p>
	</div>
	
	<div>
		<p>Cost: {{$deliverable->cost}}</p>
	</div>
    	
   <div>
	  <p>Milestone: {{$deliverable->milestone}}</p>
   </div>
   
   <div>
      <p>Package: {{$deliverable->package}}</p>
   </div>

   <div class="actions">
    <a href="{{ $deliverable->path() }}/edit">Edit</a>
    <a>Break down</a>
    <a>Move</a>
  </div>
</div>

