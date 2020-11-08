<div class="field">

    <label for="title">Title:</label>
    <input type="text" 
        name="name"
        value="{{ $status->name }}" />

</div>

<div class="field">
    <label for="title">Description:</label>
    <textarea name="description" 
        >{{ $status->description }}</textarea>
</div>

<div class="field_btn">
    <input type="submit" value="{{$btnText}}" name="create"/>
</div>