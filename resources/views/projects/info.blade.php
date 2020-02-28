<div class="groupped flex_block one_row flex_width">
    <div class="flex_block fld_space_30 around_space">
        <label for="status">Status:</label>
        <p>{{$project->status['name']}}</p>
    </div>  
    
    <div class="flex_block fld_space_30 side_space">
        <label for="started">Start date:</label>
        <p>{{$project->started}}</p>
    </div> 
    
    <div class="flex_block fld_space_30 around_space">
        <label for="finished">Comletion date:</label>
        <p>{{$project->finished}}</p>
    </div>   
</div> 
   
