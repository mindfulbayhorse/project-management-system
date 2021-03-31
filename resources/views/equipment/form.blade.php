@csrf
<input type="hidden" value="{{ Auth::id() }}" name="user_id" />

<div class="field">
    <label for="name">Name:</label>
    <input type="text" 
        name="name" 
        id="name"
        value="{{  old('name', $equipment->name) }}" />
</div>

<div class="field">
    <label for="status">Type:</label>
    <div class="group">
         <select name="resource_type_id"
            id="type">
            <option value="" 
                @if ($equipment->resource_type_id === '0')) {{ 'selected' }} @endif>Select a resource type</option>
            
                @foreach ($types as $type)
                    <option value="{{ $type['id'] }}" 
                    @if ($equipment->resource_type_id === $type['id'])) 
                        {{ 'selected' }}
                    @endif
                    >{{$type['name']}}</option>
                @endforeach
            </select>
        <a href="/resource_types/create">Add new type</a>
    </div>
</div>

<div class="field">
    <label for="status">Model:</label>
    <input type="text" 
        name="model" 
        id="model"
        value="{{ old('model', $equipment->model) }}" />
</div>

<div class="field">
    <label for="status">Cost:</label>
    <input type="text" 
        name="cost" 
        id="model"
        value="{{  old('cost', $equipment->cost) }}" />
</div>

<div class="">
    <input type="submit" class="btn" value="{{ $btnText }}" name="save"/>
</div>

    
    