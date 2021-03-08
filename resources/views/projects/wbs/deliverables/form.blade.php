@csrf

@if ($errors->deliverable->any())
    The following errors occured during the form submittion
@endif

<input type="hidden" name="project_id" value="{{$project->id}}" />

<fieldset class="form_section">
    <legend>Basic information</legend>

    <div class="detail_field title">
        <label for="title">Title: <span>*</span></label>
            @error('title', 'deliverable')
                {{ $message }}
            @enderror
            <input type="text" 
                name="title" 
                id="title"
                value="{{ old('title', $deliverable->title)}}"
            />
    </div>

    <div class="detail_field double">
        <label for="title">Cost:</label>
        <input type="text" 
            name="cost" 
            id="cost"
            value="{{$deliverable->cost}}"
        />
    </div>  

    <div class="detail_field">
        <label for="startDate"
          id="startDateLabel"
          tabindex="-1">Start date <span class="req">*<span>(required)</span></span></label>
        <span>
            <input type="date" 
                class="form-control me-3"
                id="startDate"
                name="start_date"
                required aria-required="true"
                aria-labelledby="startDateLabel startDateFormat">
            <span class="visually-hidden" 
              id="startDateFormat" 
              tabindex="-1">DD/MM/YYYY</span>
        </span>
    </div>
    
    <div class="detail_field">
      <label for="endDate"
          id="endDateLabel"
          tabindex="-1">End date <span class="req">*<span>(required)</span></span></label>
        <span>
            <input type="date" 
                class="form-control me-3"
                id="endDate"
                name="end_date"
                required aria-required="true"
                aria-labelledby="endDateLabel">
            <span class="visually-hidden" 
              id="endDateFormat" 
              tabindex="-1">DD/MM/YYYY</span>
        </span>
    </div>
    
    <div class="complex">
        <div class="detail_field_horizontal">
            <input type="checkbox" 
                name="package" 
                id="package"
            />
            <label for="package" class="full_title">Package</label>
        </div>
        
        <div class="detail_field_horizontal">
            <input type="checkbox" 
                name="milestone" 
                id="milestone"
            />
            <label for="mistone" class="full_title">Milestone</label>
        </div>
    
    </div>
   
   <div class="detail_field">  
        <input type="submit" 
            name='create' 
            value="{{ $btnTitle}}"
        />
    </div>

</fieldset>
