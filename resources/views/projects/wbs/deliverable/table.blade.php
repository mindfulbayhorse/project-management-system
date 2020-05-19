<div class="action_panel" data-bind='visible: actionsBar'>
    <ul data-bind='foreach: actions' class="flex_block one_row">
      <li>
      	<button data-bind="html: text,
        	attr: {name: id}"></button>
      </li>
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
    <tbody data-bind='foreach: wbsAll'>
        <tr tabindex='-1' data-bind='hasFocus: $root.isSelected($data)'>
            <th class="actions row_only">
                 <button name='openTree'></button>
            </th>
            <th>
	             <input type="checkbox" name="current" 
	             	data-bind="checkedValue: $data,
        				checked: $root.current"/>
	        </th>
            <td data-bind='text: entry.ID'></td>
            <td>
            	<div class="flex_block grid_rows field">
                	<input type='text' form='deliverable' 
                		data-bind="value: entry.title,
    						valueUpdate: 'input', class: entry.classTitle"/>
                </div>
	        </td>
            <td>
            	<div class="flex_block grid_rows field">
            		<input type='text' form='deliverable' 
            			data-bind="value: entry.cost,
        					valueUpdate: 'input'"  />
            	</div>
                
	        </td>
            <td>
            	<div class="flex_block grid_rows field">
                	<input type='text' form='deliverable' 
                		data-bind="value: entry.dateStart,
        					valueUpdate: 'input'"/>
                </div>
	        </td>
            <td>
            	<div class="flex_block grid_rows field">
                    <input type='text' form='deliverable' 
                    	data-bind="value: entry.dateEnd,
        					valueUpdate: 'input'"/>
                </div>
	        </td>
        </tr>
        @if (isset($wbs))
        	@include('projects.wbs.table')
        @endif
    </tbody>

</table>