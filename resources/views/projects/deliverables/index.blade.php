@extends('nav_left')

@section('title','Work breakdown structure')

@section('left_sidebar')
<h2>{{$project->title}}</h2>
<h3>Work breakdown structure</h3>
<nav>
  <ul>
      <li></li>
  </ul>
</nav>
@endsection

@section('content')
    	        <main id="WBS">
			    
			    <form id="deliverable" name="deliverable" class="groupped flex_block one_row">
			    
			        <div class="flex_block grid_rows col_1">
			        
			            <div class="flex_block one_column">
			                <label for="title">Title:</label>
			                <input maxlength='100' type="text" name="title" data-template='newTitle'/>
			            </div> 	
			            
			            <div class="flex_block one_row">
			            
			              <div class="flex_block one_column">
			                  <label for="dateStart">Start date:</label>
			                  <input maxlength='10' type="text" name="dateStart" data-template='newDateStart'/>
			              </div>
			              
			              <div class="flex_block one_column">
			                  <label for="dateEnd">End date:</label>
			                  <input maxlength='10' type="text" name="dateEnd" data-template='newDateEnd'/>
			              </div>
			              
			            </div>		        
			        </div>
			        
			        <div class="flex_block one_column grid_rows col_2">
			            
			            <div class="flex_block one_column">
			                <label for="cost">Cost:</label>
			                <input maxlength='10' type="text" name="cost" data-template='newCost'/>
			            </div>
			            
			            <div class="flex_block one_column">
			                <label for="cost">Work amount:</label>
			                <input maxlength='10' type="text" name="period"/>
			            </div>
			            
			        </div>
			        
			        <div class="flex_block one_column grid_rows col_3">
			            
			            <div class="flex_block one_column">
			                <label for="parentID">Package is ready:</label>
			                <input type="checkbox" name="package" data-template='newPackage'/>
			            </div>
			            
			            <div class="flex_block one_column">
			                <input type="submit" name='create' value="Create" data-template='addNew'/>
			            </div>
			            
			        </div>

			    </form>
			    
			    <div class="action_panel">
			      <ul data-template='actions'>
			          <li><button data-template='action'></button></li>
			      </ul>
			    </div>
			    
			    <table>
			        <caption>The table shows all deliverables for 
			             project in the tree</caption>
			        <thead>
			            <tr>
			               <th></th>
			               <th></th>
			               <th>Level</th>
			               <th>Title</th>
			               <th>Cost</th>
			               <th>Starts from</th>
			               <th>Finishes on</th>
			           </tr>
			        </thead>
			        <tbody data-template='deliverables'>
			         
			            <tr tabindex='-1' data-template='setCurrent'>
			            
			                <th class="actions row_only">
			                    <button name='openTree'>Fold</button>         
			                </th>
			                
			                <th>
			                    <input type="radio" data-template="setCurrent" name="current">
			                </th>
			
			                <td data-template='recordID'></td>
			                <td data-template='_index'>
			                    <input type='text' data-template='recordTitle' 
			                       form='deliverable' name='title' value='' />
			                </td>
			                <td>
			                    <input type='text' data-template='recordCost' 
			                       form='deliverable' value='' />
			                </td>
			                <td>
			                    <input type='text' data-template='recordDateStart' 
			                       form='deliverable' value='' />
			                </td>
			                <td>
			                    <input type='text' data-template='recordDateEnd' 
			                       form='deliverable' value='' />
			                </td>
			            </tr>
			 
			        </tbody>
			    </table>
			    
			</main>
@endsection