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
    <input type="text" 
        name="type" 
        id="type"
        value="{{ old('type', $equipment->type) }}" />
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

    
    