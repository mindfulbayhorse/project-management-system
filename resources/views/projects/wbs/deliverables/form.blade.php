@csrf

@if ($errors->deliverable->any())
    The following errors occured during the form submittion
@endif

<input type="hidden" name="project_id" value="{{$project->id}}" />
  
    <div class="form_section">
        <div class="detail_field title">
            <label for="title">Title: <span>*</span></label>
                @error('title', 'deliverable')
                    {{ $errors->deliverable->first('title') }}
                @enderror
                <input type="text" 
                    name="title" 
                    id="title"
                    value="{{ old('title', $deliverable->title)}}"
                />
        </div>
        
        <div class="complex">
            <div class="detail_field double">
                <label for="title">Cost:</label>
                @error('cost', 'deliverable')
                    {{ $errors->deliverable->first('title') }}
                @enderror
                <input type="text" 
                    name="title" 
                    id="title"
                    value="{{$deliverable->title}}"
                />
            </div>  
            
             <div class="detail_field double">
                <label for="order">Order:</label>
                <input type="text" 
                    name="order" 
                    id="order"
                    value="{{$deliverable->order}}"
                />
           </div>
        </div>
    </div>
    
    <div class="form_section dates">
        
        <div class="detail_field">
            @include('blocks.date', ['nameDate' => 'start_date', 'legend' => 'Start date'])
        </div>
        <div class="detail_field">
          @include('blocks.date', ['nameDate' => 'end_date', 'legend' => 'End date'])
        </div>
    </div>  
    
     <div class="form_section">
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
     </div>  
