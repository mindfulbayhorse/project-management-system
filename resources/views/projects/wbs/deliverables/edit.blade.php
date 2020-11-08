@extends('layout')

@section('title','Edit deliverable')

@section('content')

@include('show_err') 
 
<form id="deliverable" 
    name="deliverable" 
    method="POST" 
    action="{{ $deliverable->path() }}"
    class="deliverable new">

    @method('PATCH')
    
    <input type="hidden" name="id" value="{{$deliverable->id}}" />
    
    @include('projects.wbs.deliverables.form',  [
            'btnTitle' => 'Save'
     ])

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