@foreach ($wbs as $deliverable)

    <tr tabindex='-1'>
    	<th class="actions row_only">
    		<div class="flex_block one_row field">
    			{{ $deliverable->order }}
    			<button name='openTree'>Fold</button>
    		</div>
    	</th>
    	<th>
    		<div class="flex_block one_row field">
    			<input type="radio" name="current" form="deliverable">
    		</div>
    	</th>
    	<td data-template='recordID'>
    		<div class="flex_block one_row field">
    			{{$loop->iteration}} {{ $deliverable->id }} {{ $deliverable->parent_id }}
    		</div>
    	</td>
    	<td>
    		<div class="flex_block one_row field">
    			<a href="/projects/{{$project->id}}/wbs/{{$deliverable->id}}">{{$deliverable->title}}</a>
    		</div>
    	</td>
    	<td>
    		<div class="flex_block one_row field">
    			{{ $deliverable->cost }}
    		</div>
    	</td>
    	<td>
    		<div class="flex_block one_row field">
    			{{ $deliverable->start_date }}
    		</div>
    	</td>
    	<td>
    		<div class="flex_block one_row field">
    			{{ $deliverable->end_date }}
    		</div>
    	</td>
    	<td>
    		<div class="flex_block one_row field">
    			{{ $deliverable->work_amount }}
    		</div>
    	</td>
    	<td>
    		<div class="flex_block one_row field">
    			{{ $deliverable->work_amount_id }}
    		</div>
    	</td>
    </tr>

@endforeach
