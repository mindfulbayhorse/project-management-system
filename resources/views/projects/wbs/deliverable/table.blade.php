<div class="action_panel" data-template='actionsBar'>
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
        <tr tabindex='-1' data-template='isSelected'>
            <th class="actions row_only">
                 <button name='openTree'></button>
            </th>
            <th>
	             <input type="checkbox" name="current" data-template='setCurrent'>
	        </th>
            <td data-template='recordID'></td>
            <td>
            	<div class="flex_block grid_rows field">
                	<input type='text' data-template='recordTitle' form='deliverable'/>
                </div>
	        </td>
            <td>
            	<div class="flex_block grid_rows field">
            		<input type='text' data-template='recordCost' form='deliverable' />
            	</div>
                
	        </td>
            <td>
            	<div class="flex_block grid_rows field">
                	<input type='text' data-template='recordDateStart' form='deliverable'/>
                </div>
	        </td>
            <td>
            	<div class="flex_block grid_rows field">
                    <input type='text' data-template='recordDateEnd' form='deliverable'/>
                </div>
	        </td>
        </tr>
        @if (isset($wbs))
        	@include('projects.wbs.table')
        @endif
    </tbody>

</table>