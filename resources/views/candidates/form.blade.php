@csrf

<div class="long_field title">
    <label for="title">Name:</label>
    <input type="text" 
        name="name" 
        id="title"
        value="{{ $candidate->name }}" />
</div>

<div class="long_field title">
    <label for="title">Email:</label>
    <input type="text" 
        name="email" 
        id="title"
        value="{{ $candidate->email }}" />
</div>

<div class="">
    <input type="submit" class="btn" value="{{ $btnText }}" name="save"/>
</div>

    
    