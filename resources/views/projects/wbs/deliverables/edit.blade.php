@extends('layout')

@section('title','Edit deliverable')

@section('content')

@include('show_err') 
 
<form id="deliverable" 
    name="deliverable" 
    method="POST" 
    action="{{ $project->path() }}/deliverables/{{ $deliverable->id }}"
    class="groupped flex_block one_row flex_width">

    @csrf
    @method('PATCH')
    
    <input type="hidden" name="id" value="{{$deliverable->id}}" />
    
    <div class="flex_block grid_rows fld_space_30 around_space">
    
        <div class="flex_block one_column fld_space_100 bottom_space">
            <label for="title">Title:</label>
            <input maxlength='150' 
                type="text" 
                name="title" 
                value="{{ $deliverable->title }}"/>
        </div>  
        
        <div class="flex_block one_row fld_space_100">
        
          <div class="flex_block one_column fld_space_45_left">
              <label for="dateStart">Start date:</label>
              <input maxlength='10' 
                type="text" 
                name="start_date" 
                value="{{ $deliverable->start_date }}"/>
          </div>
          
          <div class="flex_block one_column fld_space_45_right">
              <label for="dateEnd">End date:</label>
              <input maxlength='10' 
                type="text" 
                name="end_date" 
                value="{{ $deliverable->end_date }}"/>
          </div>
          
        </div>
    </div>
        
    <div class="flex_block grid_rows fld_space_30 bottom_top_space">
        
        <div class="flex_block one_column fld_space_100 bottom_space">
            <label for="cost">Cost:</label>
            <input maxlength='10' 
                type="text" 
                name="cost" 
                value="{{ $deliverable->cost }}"/>
        </div>
        
        <div class="flex_block one_column fld_space_100">
            <label for="cost">Work amount:</label>
            <input maxlength='10' 
                type="text" 
                name="period"/>
        </div>
        
    </div>
    
    <div class="flex_block grid_rows fld_space_30 around_space">
        
        <div class="flex_block one_column fld_space_100 bottom_space">
            <label for="parentID">Package is ready:</label>
            <input type="checkbox" name="package" {{ $deliverable->package? "checked" : ""}} />
        </div>
        
        <div class="flex_block one_column fld_space_100">
            <input type="submit" name='create' value="Save"/>
        </div>
        
    </div>
</form>
    
<main>
    @if($deliverable->children->count() >0)
	  <form name="deliverables" action="">
	     <table>
	        <caption>Work Breakdown structure</caption>
	        <thead>
	            <th>Ordinal number</th>
	            <th>Title</th>
	            <th>Cost</th>
	            <th>Start date</th>
	            <th>End date</th>
	            <th>Package</th>
	        </thead>
	        <tbody>
	            
	            @foreach ($deliverable->children as $detail)
	
	                <tr tabindex='-1'>
	                    <td data-template='recordID'>
	                        <div class="flex_block one_row field">
	                            {{ $detail->order }}
	                        </div>
	                    </td>
	                    <td>
	                        <div class="flex_block one_row field">
	                            <a href="{{ $wbs->path() }}/deliverable/{{ $deliverable->id}}"
	                                >{{$detail->title}}</a>
	                        </div>
	                    </td>
	                    <td>
	                        <div class="flex_block one_row field">
	                            {{ $detail->cost }}
	                        </div>
	                    </td>
	                    <td>
	                        <div class="flex_block one_row field">
	                            {{ $detail->start_date }}
	                        </div>
	                    </td>
	                    <td>
	                        <div class="flex_block one_row field">
	                            {{ $detail->end_date }}
	                        </div>
	                    </td>
	                    <td>
	                        <input type="checkbox" name="package[{{ $detail->id}}]" />
	                    </td>
	                </tr>
	            
	            @endforeach
	        
	        </tbody>
	
	    </table>
	
	  </form>
    @else
        <div>No deliverables are created yet</div>
    @endif
</main>
@endsection