@csrf
<div class="long_field">
    <label for="users">Users:</label>
    <div class="group">
         <select name="user_id" id="users">
            <option value="">Select a candidate</option>
            
            @foreach ($users as $user)
                <option value="{{ $user['id'] }}">{{$user['name']}}</option>
            @endforeach
        </select>

        <input type="submit" class="btn" value="{{ $btnText }}" name="save"/>
    </div>
</div>

    
    