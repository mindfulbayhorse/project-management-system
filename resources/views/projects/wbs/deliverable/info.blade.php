<form id="deliverable" 
    name="deliverable" 
    method="POST" 
    action="/projects/{{ $project->id }}/wbs/{{$deliverable->id}}" 
	class="groupped flex_block one_row flex_width" 
    data-template="breakdown">
	
	@csrf
	@method('PATCH')
	
	<input type="hidden" name="parent_id" value="{{$deliverable->parent_id}}" />
	
	<input type="hidden" name="project_id" value="{{$project->id}}" />
	
	<input type="hidden" name="deliverableID" data-template='newID' value="{{$deliverable->id}}" />

	<div class="flex_block grid_rows fld_space_30 around_space">
	
		<div class="flex_block one_column fld_space_100 bottom_space">
			<label for="title">Title:</label>
			<input maxlength='150' type="text" name="title" value="{{$deliverable->title}}" data-template='newTitle'/>
		</div>
		
		<div class="flex_block one_row fld_space_100 bottom_top_space">
		
			<div class="flex_block one_column fld_space_45_left">
				<label for="dateStart">Start date:</label>
				<input maxlength='20' type="text" name="start_date" value="{{$deliverable->start_date}}" data-template='newDateStart' />
			</div>
			
			<div class="flex_block one_column fld_space_45_left">
				<label for="dateEnd">End date:</label>
				<input maxlength='20' type="text" name="end_date" value="{{$deliverable->end_date}}" data-template='newDateStart' />
			</div>
		</div>
	</div>
	
	<div class="flex_block grid_rows fld_space_30 bottom_top_space">
	
		<div class="flex_block one_column fld_space_100 bottom_space">
			<label for="cost">Order:</label>
			<input maxlength='5' type="text" name="order" value="{{$deliverable->order}}"/>
		</div>
		
		<div class="flex_block one_row fld_space_100 bottom_space">
			<div class="flex_block one_column fld_space_45_left">
				<label for="cost">Cost:</label>
				<input maxlength='10' type="text" name="cost" value="{{$deliverable->cost}}"/>
			</div>
			
			<div class="flex_block one_column fld_space_45_left">
				<label for="cost">Work amount:</label>
				<input maxlength='10' type="text" name="work_amount" value="{{$deliverable->work_amount}}"/>
			</div>
		</div>
	</div>
	
	<div class="flex_block grid_rows fld_space_30 around_space">
	
		<div class="flex_block one_column fld_space_100">
	
			<input type="submit" value="Update" name="update_{{$deliverable->id}}"/>
		</div>
		
	</div>
</form>
