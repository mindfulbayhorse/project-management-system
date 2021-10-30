@csrf

<div class="field">
    <label for="field">Section code:</label>
    <input type="text" 
        name="code" 
        id="title"
        value="{{ old('name', $role->name) }}" />
</div>

<div class="field">
    <label for="title">Section title:</label>
    <input type="text" 
        name="title" 
        id="title"
        value="{{ old('label', $role->label) }}" />
</div>

<div class="">
    <input type="submit" class="btn" value="{{ $btnText }}" name="save"/>
</div>