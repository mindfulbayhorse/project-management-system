@extends('layout')

@section('title','Edit a project')

@section('content')

@include('show_err') 
 
<form id="deliverable" 
    name="deliverable" 
    method="POST" 
    action="{{ $wbs->path() }}"
    class="groupped flex_block one_row flex_width">

    @csrf
    @method('PATCH')
    
    <input type="hidden" name="project_id" value="{{$project->id}}" /> 
    <input type="hidden" name="id" value="{{$wbs->id}}" />
    

    <div class="flex_block grid_rows fld_space_30 around_space">
    
        <div class="flex_block one_column fld_space_100 bottom_space">
            <label for="title">Title:</label>
            <input maxlength='150' 
                type="text" 
                name="title" 
                value="{{ old('title') }}"/>
        </div>  
        
        <div class="flex_block one_row fld_space_100">
        
          <div class="flex_block one_column fld_space_45_left">
              <label for="dateStart">Start date:</label>
              <input maxlength='10' 
                type="text" 
                name="start_date" 
                value="{{ old('start_date') }}"/>
          </div>
          
          <div class="flex_block one_column fld_space_45_right">
              <label for="dateEnd">End date:</label>
              <input maxlength='10' 
                type="text" 
                name="end_date" 
                value="{{ old('end_date') }}"/>
          </div>
          
        </div>
    </div>
        
    <div class="flex_block grid_rows fld_space_30 bottom_top_space">
        
        <div class="flex_block one_column fld_space_100 bottom_space">
            <label for="cost">Cost:</label>
            <input maxlength='10' 
                type="text" 
                name="cost" 
                value="{{ old('cost') }}"/>
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
            <input type="checkbox" name="package" />
        </div>
        
        <div class="flex_block one_column fld_space_100">
            <input type="submit" name='create' value="Create"/>
        </div>
        
    </div>
</form>
    
<main>
    
    <table>
        <caption>Work Breakdown structure</caption>
        <thead>
            <th></th>
            <th></th>
            <th>Ordinal number</th>
            <th>Title</th>
            <th>Cost</th>
            <th>Start date</th>
            <th>End date</th>
        </thead>
        <tbody>
            
            @foreach ($wbs->deliverables as $deliverable)

                <tr tabindex='-1'>
                    <th class="actions row_only">
                        <div class="flex_block one_row field">
                            {{ $deliverable->order }}
                            <button name='openTree'>Fold</button>
                        </div>
                    </th>
                    <th>
                        <div class="flex_block one_row field">
                            <input type="radio" name="current" form="deliverable">
                        </div>
                    </th>
                    <td data-template='recordID'>
                        <div class="flex_block one_row field">
                            {{$loop->iteration}} {{ $deliverable->id }} {{ $deliverable->parent_id }}
                        </div>
                    </td>
                    <td>
                        <div class="flex_block one_row field">
                            <a href="{{$wbs->path() }}">{{$deliverable->title}}</a>
                        </div>
                    </td>
                    <td>
                        <div class="flex_block one_row field">
                            {{ $deliverable->cost }}
                        </div>
                    </td>
                    <td>
                        <div class="flex_block one_row field">
                            {{ $deliverable->start_date }}
                        </div>
                    </td>
                    <td>
                        <div class="flex_block one_row field">
                            {{ $deliverable->end_date }}
                        </div>
                    </td>
                    <td>
                        <div class="flex_block one_row field">
                            {{ $deliverable->work_amount }}
                        </div>
                    </td>
                    <td>
                        <div class="flex_block one_row field">
                            {{ $deliverable->work_amount_id }}
                        </div>
                    </td>
                </tr>
            
            @endforeach
        
        </tbody>

    </table>
    
</main>
@endsection