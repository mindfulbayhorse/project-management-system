@csrf

<div class="field">
    <label for="field">Name:</label>
    <input type="text" 
        name="first_name" 
        id="title"
        value="{{ old('first_name', $candidate->first_name) }}" />
</div>

<div class="field">
    <label for="title">Last name:</label>
    <input type="text" 
        name="last_name" 
        id="title"
        value="{{ old('last_name',$candidate->last_name) }}" />
</div>

<div class="field">
    <label for="title">Email:</label>
    <input type="text" 
        name="email" 
        id="title"
        value="{{ old('email', $candidate->email) }}" />
</div>

<div class="">
    <input type="submit" class="btn" value="{{ $btnText }}" name="save"/>
</div>

    
    