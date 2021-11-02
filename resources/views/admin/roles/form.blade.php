@csrf

<div class="field">
    <label for="name">Section name:</label>
    <input type="text" 
        name="name" 
        id="name"
        value="{{ old('name', $role->name) }}" />
</div>

<div class="field">
    <label for="label">Section label:</label>
    <input type="text" 
        name="label" 
        id="label"
        value="{{ old('label', $role->label) }}" />
</div>

<div class="">
    <input type="submit" class="btn" value="{{ $btnText }}" name="save"/>
</div>