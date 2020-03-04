@if ($project->deliverables->count())
    <div class="action_panel">
        <ul data-template='actions' class="flex_block one_row">
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
                    	<div class="flex_block one_row field">
		                	<button name='openTree'>Fold</button>
		                </div>
		            </th>
		            <th>
		            	<div class="flex_block one_row field">
			            	<input type="radio"  name="current" form="deliverable">
			            </div>
			        </th>
                    <td data-template='recordID'>
                    	<div class="flex_block one_row field">{{$loop->iteration}}
                    	</div>
                   	</td>
                    <td>
                    	<div class="flex_block one_row field">
                        	<a href="/projects/{{$project->id}}/deliverables/{{$deliverable->id}}">{{$deliverable->title}}</a>
                        	<input type='text' data-template='recordTitle' 
			                       form='deliverable' name='title' value='' />
			            </div>
			        </td>
                    <td>
                    	<div class="flex_block one_row field">
                        	<input type='text' data-template='recordCost' 
			                       form='deliverable' value='{{ $deliverable->cost }}' />
			            </div>
			        </td>
                    <td>
                    	<div class="flex_block one_row field">
                        	<input type='text' data-template='recordDateStart' 
			                       form='deliverable' value='{{ $deliverable->start_date }}' />
			            </div>
			        </td>
                    <td>
                    	<div class="flex_block one_row field">
                        	<input type='text' data-template='recordDateEnd' 
			                       form='deliverable' value='{{ $deliverable->end_date }}' />
			            </div>
			        </td>
                </tr>

            @endforeach
        </tbody>
    
    </table>
    <form id="deliverable">
    </form>
@endif