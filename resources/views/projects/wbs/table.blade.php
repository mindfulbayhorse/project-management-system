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
        <tr tabindex='-1' data-template='setCurrent'>
            <th class="actions row_only">
                 <button name='openTree'></button>         
            </th>
            <th>
	             <input type="radio" data-template="setCurrent" name="current">
	        </th>
            <td data-template='recordID'></td>
            <td>
                <input type='text' data-template='recordTitle' form='deliverable' />
	        </td>
            <td>
                <input type='text' data-template='recordCost' form='deliverable' />
	        </td>
            <td>
                <input type='text' data-template='recordDateStart' form='deliverable' />
	        </td>
            <td>
                <input type='text' data-template='recordDateEnd' form='deliverable'/>
	        </td>
        </tr>
    </tbody>

</table>
<form id="deliverable"></form>