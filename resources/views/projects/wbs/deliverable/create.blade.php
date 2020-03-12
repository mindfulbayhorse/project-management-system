@include('show_err')

    <form id="deliverable" name="deliverable" method="POST" action="/projects/{{ $project->id }}/deliverables"
        class="groupped flex_block one_row flex_width" data-template="request">

        @csrf
        
        @if (isset($deliverable))
        	<input type="hidden" name="parent_id" value="{{$deliverable->id}}" />
        @endif
        
        <input type="hidden" name="project_id" value="{{$project->id}}" /> 
        <input type="hidden" name="deliverableID" data-template='newID' /> 

        <div class="flex_block grid_rows fld_space_30 around_space">
        
            <div class="flex_block one_column fld_space_100 bottom_space">
                <label for="title">Title:</label>
                <input maxlength='150' type="text" name="title" value="{{ old('title') }}" data-template='newTitle'/>
            </div> 	
            
            <div class="flex_block one_row fld_space_100">
            
              <div class="flex_block one_column fld_space_45_left">
                  <label for="dateStart">Start date:</label>
                  <input maxlength='10' type="text" name="start_date" value="{{ old('start_date') }}" data-template='newDateStart' />
              </div>
              
              <div class="flex_block one_column fld_space_45_right">
                  <label for="dateEnd">End date:</label>
                  <input maxlength='10' type="text" name="end_date" value="{{ old('end_date') }}" data-template='newDateEnd' />
              </div>
              
            </div>
        </div>
	        
        <div class="flex_block grid_rows fld_space_30 bottom_top_space">
            
            <div class="flex_block one_column fld_space_100 bottom_space">
                <label for="cost">Cost:</label>
                <input maxlength='10' type="text" name="cost" value="{{ old('cost') }}"/>
            </div>
            
            <div class="flex_block one_column fld_space_100">
                <label for="cost">Work amount:</label>
                <input maxlength='10' type="text" name="period"/>
            </div>
            
        </div>
        
        <div class="flex_block grid_rows fld_space_30 around_space">
            
            <div class="flex_block one_column fld_space_100">
                <label for="parentID">Package is ready:</label>
                <input type="checkbox" name="package" />
            </div>
            
            <div class="flex_block one_column fld_space_100">
                <input type="submit" name='create' value="Create" data-template='addNew'/>
            </div>
            
        </div>
    </form>
