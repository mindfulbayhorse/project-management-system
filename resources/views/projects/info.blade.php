<div class="groupped flex_block one_row flex_width">
    <div class="flex_block fld_space_20 around_space">
    	<div class="flex_block one_column fld_space_100">
        	<label for="status">Status:</label>
        	<p>{{$project->status['name']}}</p>
        </div>
    </div>
    
    <div class="flex_block fld_space_20 bottom_top_space">
    	<div class="flex_block one_column fld_space_100">
        	<label for="started">Start date:</label>
        	<p>{{$project->started}}</p>
        </div>
    </div> 
    
    <div class="flex_block fld_space_20 bottom_top_space">
    	<div class="flex_block one_column fld_space_100">
        	<label for="finished">Comletion date:</label>
        	<p>{{$project->finished}}</p>
        </div>
    </div>
    
    <div class="flex_block fld_space_20 around_space">
    	<a href="/projects/{{$project->id}}/edit" class="btn">Edit project</a>
    </div>
</div>
