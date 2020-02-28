@if ($project->deliverables->count())
    <div class="action_panel">
        <ul data-template='actions' class="flex_block one_row">
          <li><button data-template='action'></button></li>
        </ul>
    </div>
    <table>
        <caption>Work Breakdown structure</caption>
        <!-- <thead class="flex_block one_row">
            <th></th>
            <th></th>
            <th>Ordinal number</th>
            <th>Title</th>
            <th>Cost</th>
            <th>Start date</th>
            <th>End date</th>
        </thead>-->
        <tbody data-template='deliverables'>
            
            @foreach ($project->deliverables as $deliverable)

                <tr tabindex='-1' data-template='setCurrent'>
                    <th class="actions row_only">
		                 <button name='openTree'>Fold</button>         
		            </th>
		            <th class="flex_block one_column">
			             <input type="radio"  name="current" form="deliverable">
			        </th>
                    <td data-template='recordID'>{{$loop->index}}</td>
                    <td class="flex_block">
                        <a href="/projects/{{$project->id}}/deliverables/{{$deliverable->id}}">{{$deliverable->title}}</a>
                        <input type='text' data-template='recordTitle' 
			                       form='deliverable' name='title' value='' />
			        </td>
                    <td class="flex_block one_column">
                        <input type='text' data-template='recordCost' 
			                       form='deliverable' value='{{ $deliverable->cost }}' />
			        </td>
                    <td class="flex_block one_column">
                        <input type='text' data-template='recordDateStart' 
			                       form='deliverable' value='{{ $deliverable->start_date }}' />
			        </td>
                    <td class="flex_block one_column">
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