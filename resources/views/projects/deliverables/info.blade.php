<div class="groupped flex_block one_row flex_width" data-template="breakdown">

	<div class="flex_block grid_rows fld_space_50 around_space">
	
		<div class="flex_block one_column fld_space_100 bottom_space">
			<label for="title">Title:</label>
			<input maxlength='100' type="text" name="title" value="{{ old('title') }}" data-template='parentTitle' />
		</div>
		
		<div class="flex_block one_row fld_space_100">
		
			<div class="flex_block one_column fld_space_45_left">
				<label for="dateStart">Start date:</label>
				<input maxlength='10' type="text" name="start_date" value="{{ old('start_date') }}"
					data-template='parentDateStart' />
			</div>
			
			<div class="flex_block one_column fld_space_45_right">
				<label for="dateEnd">End date:</label>
				<input maxlength='10' type="text" name="end_date" value="{{ old('end_date') }}"
					data-template='parentDateEnd' />
			</div>
		</div>
	</div>
	
	<div class="flex_block grid_rows fld_space_50 side_space">
		<div class="flex_block one_column fld_space_100 bottom_space">
			<label for="cost">Cost:</label>
			<input maxlength='10' type="text" name="cost" value="{{ old('cost') }}" />
		</div>
		<div class="flex_block one_column fld_space_100">
			<label for="cost">Work amount:</label>
			<input maxlength='10' type="text" name="period" />
		</div>
	</div>
</div>
