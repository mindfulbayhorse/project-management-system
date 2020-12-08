@csrf

@if ($errors->deliverable->any())
    The following errors occured during the form submittion
@endif

<input type="hidden" name="project_id" value="{{$project->id}}" />

<div class="long_field">
    <label for="order">Order:</label>
    <input type="text" 
        name="order" 
        id="order"
        value="{{$deliverable->order}}"
    />
</div>  
  
<div class="long_field">
    <label for="title">Title:</label>
    @error('title', 'deliverable')
        {{ $errors->deliverable->first('title') }}
    @enderror
    <input type="text" 
        name="title" 
        id="title"
        value="{{$deliverable->title}}"
    />
</div>  
    
<div class="long_field_complex">
    <div class="detail_field">
      <label for="dateStart">Start date:</label>
      <input type="text" 
        name="start_date"
        id="dateStart"
        value="{{$deliverable->start_date}}"
      />
    </div>
      
    <div class="detail_field">
      <label for="dateEnd" class="title_long">End date:</label>
      <input type="text" 
        name="end_date" 
        id="dateEnd"
        value="{{$deliverable->end_date}}"
      />
    </div>    
</div>

<div class="long_field_complex">
    <div class="detail_field">
        <label for="cost">Cost:</label>
        <input type="text" 
            name="cost" 
            id="cost"
            value="{{$deliverable->cost}}"
        />
    </div>
    
    <div class="detail_field_horizontal">
        <input type="checkbox" 
            name="package" 
            id="package"
        />
        <label for="package" class="full_title">Package</label>
        <input type="checkbox" 
            name="milestone" 
            id="milestone"
        />
        <label for="mistone" class="full_title">Milestone</label>
    </div>
</div>



<div class="long_field_button">  
        <input type="submit" 
            name='create' 
            value="{{ $btnTitle}}"
        />
</div>
