
<div data-template="showErrMsg">
<p>Errors are found in project WBS creating!</p>
</div>
<div data-template="showErrors"></div>
<form id="deliverable" name="deliverable" method="POST" action="/projects/{{ $project->id }}/deliverables"
    class="groupped flex_block one_row row_wide">
    
    <input type="hidden" name="project_id" value="{{$project->id}}" /> 

        <div class="flex_block grid_rows">
        
            <div class="flex_block one_column fld_space_100">
                <label for="title">Title:</label>
                <span data-template="validTitle">Title is required!</span>
                <input type="text" data-template='newTitle' />
            </div> 	
            
            <div class="flex_block one_row fld_space_100">
            
              <div class="flex_block one_column fld_space_50_left">
                  <label for="dateStart">Start date:</label>
                  <input type="text" data-template='newDateStart' />
              </div>
              
              <div class="flex_block one_column fld_space_50_right">
                  <label for="dateEnd">End date:</label>
                  <input type="text" name="end_date" data-template='newDateEnd' />
              </div>
              
            </div>		        
        </div>
        
        <div class="flex_block grid_rows">
            
            <div class="flex_block one_column fld_space_100">
                <label for="cost">Cost:</label>
                <input type="text"  data-template='newCost' />
            </div>
            
            <div class="flex_block one_column fld_space_100">
                <label for="cost">Work amount:</label>
                <input type="text" />
            </div>
            
        </div>
        
        <div class="flex_block grid_rows">
            
            <div class="flex_block one_column fld_space_100">
                <label for="parentID">Package is ready:</label>
                <input type="checkbox" name="package" />
            </div>
            
            <div class="flex_block one_column fld_space_100">
                <input type="submit" value="Create" data-template='addNew'/>
            </div>
            
        </div>
</form>
