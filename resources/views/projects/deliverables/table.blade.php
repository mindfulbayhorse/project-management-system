@if ($project->deliverables->count())
    <div class="action_panel">
        <ul data-template='actions'>
          <li><button data-template='action'></button></li>
        </ul>
    </div>
    <table>
        <caption>Work Breakdown structure</caption>
        <thead>
            <th></th>
            <th></th>
            <th>Ordinal number</th>
            <th>Title</th>
            <th>Cost</th>
            <th>Start date</th>
            <th>End date</th>
        </thead>
        <tbody data-template='deliverables'>
            
            @foreach ($project->deliverables as $deliverable)

                <tr tabindex='-1' data-template='setCurrent'>
                    <th class="actions row_only">
		                 <button name='openTree'>Fold</button>         
		            </th>
		            <th>
			             <input type="radio"  name="current" form="deliverable">
			        </th>
                    <td data-template='recordID'>{{$loop->index}}</td>
                    <td>
                        <a href="/projects/{{$project->id}}/deliverables/{{$deliverable->id}}">{{$deliverable->title}}</a>
                        <input type='text' data-template='recordTitle' 
			                       form='deliverable' name='title' value='' />
			        </td>
                    <td>
                        <input type='text' data-template='recordCost' 
			                       form='deliverable' value='{{ $deliverable->cost }}' />
			        </td>
                    <td>
                        <input type='text' data-template='recordDateStart' 
			                       form='deliverable' value='{{ $deliverable->start_date }}' />
			        </td>
                    <td>
                        <input type='text' data-template='recordDateEnd' 
			                       form='deliverable' value='{{ $deliverable->end_date }}' />
			        </td>
                </tr>

            @endforeach
        </tbody>
    
    </table>
    <form id="deliverable">
    </form>
@endif