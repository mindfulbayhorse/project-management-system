@csrf

<div class="field">

    <label for="title">Title:</label>
    <input type="text" 
        name="name"
        value="{{ old('name', $type->name)}}" />

</div>

<div class="field_btn">
    <input type="submit" value="{{$btnText}}" name="save"/>
</div>