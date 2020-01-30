@include('show_err')

    <form id="deliverable" name="deliverable" method="POST" action="/projects/{{ $project->id }}/deliverables"
        class="groupped flex_block one_row">

        @csrf
        
        <input type="hidden" name="project_id" value="{{$project->id}}" /> 

	        <div class="flex_block grid_rows col_1">
	        
	            <div class="flex_block one_column wide">
	                <label for="title">Title:</label>
	                <input maxlength='100' type="text" name="title" data-template='newTitle' value="{{ old('title') }}" />
	            </div> 	
	            
	            <div class="flex_block one_row">
	            
	              <div class="flex_block one_column">
	                  <label for="dateStart">Start date:</label>
	                  <input maxlength='10' type="text" name="start_date" data-template='newDateStart' value="{{ old('start_date') }}" />
	              </div>
	              
	              <div class="flex_block one_column">
	                  <label for="dateEnd">End date:</label>
	                  <input maxlength='10' type="text" name="end_date" data-template='newDateEnd' value="{{ old('end_date') }}" />
	              </div>
	              
	            </div>		        
	        </div>
	        
	        <div class="flex_block grid_rows col_2">
	            
	            <div class="flex_block one_column">
	                <label for="cost">Cost:</label>
	                <input maxlength='10' type="text" name="cost" data-template='newCost' value="{{ old('cost') }}"/>
	            </div>
	            
	            <div class="flex_block one_column">
	                <label for="cost">Work amount:</label>
	                <input maxlength='10' type="text" name="period"/>
	            </div>
	            
	        </div>
	        
	        <div class="flex_block grid_rows col_3">
	            
	            <div class="flex_block one_column">
	                <label for="parentID">Package is ready:</label>
	                <input type="checkbox" name="package" />
	            </div>
	            
	            <div class="flex_block one_column">
	                <input type="submit" name='create' value="Create" data-template='addNew'/>
	            </div>
	            
	        </div>
    </form>
