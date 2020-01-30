
<form id="deliverable" name="deliverable" method="POST" action="/projects/{{ $project->id }}/deliverables"
    class="groupped flex_block one_row">
    
    <input type="hidden" name="project_id" value="{{$project->id}}" /> 

        <div class="flex_block grid_rows col_1">
        
            <div class="flex_block one_column wide">
                <label for="title">Title:</label>
                <input type="text" data-template='newTitle' />
            </div> 	
            
            <div class="flex_block one_row">
            
              <div class="flex_block one_column">
                  <label for="dateStart">Start date:</label>
                  <input type="text" data-template='newDateStart' />
              </div>
              
              <div class="flex_block one_column">
                  <label for="dateEnd">End date:</label>
                  <input type="text" name="end_date" data-template='newDateEnd' />
              </div>
              
            </div>		        
        </div>
        
        <div class="flex_block grid_rows col_2">
            
            <div class="flex_block one_column">
                <label for="cost">Cost:</label>
                <input type="text"  data-template='newCost' />
            </div>
            
            <div class="flex_block one_column">
                <label for="cost">Work amount:</label>
                <input type="text" />
            </div>
            
        </div>
        
        <div class="flex_block grid_rows col_3">
            
            <div class="flex_block one_column">
                <label for="parentID">Package is ready:</label>
                <input type="checkbox" name="package" />
            </div>
            
            <div class="flex_block one_column">
                <input type="submit" value="Create" data-template='addNew'/>
            </div>
            
        </div>
</form>
