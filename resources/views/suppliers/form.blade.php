@csrf
<div class="long_field title">
    <label for="title">Title:</label>
    <input type="text" 
        name="name" 
        id="title"
        value="{{ old('value', $supplier->name) }}" />
</div>

 <div class="long_field">
    <label for="url">URL:</label>
         <input name="url"
            id="url"
            value="{{ old('value', $supplier->url) }}">
</div>


<div class="">
    <input type="submit" class="btn" value="{{ $btnText }}" name="save"/>
</div>

    
    