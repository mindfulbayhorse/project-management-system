@csrf
<input type="hidden" value="{{ Auth::id() }}" name="user_id" />

<div class="long_field title">
    <label for="title">Title:</label>
    <input type="text" 
        name="title" 
        id="title"
        value="{{ $project->title }}" />
</div>

 <div class="long_field">
    <label for="status">Status:</label>
    <div class="group">
         <select name="status_id"
            id="status">
            <option value="" 
                @if ($project->status === '0')) {{ 'selected' }} @endif>Select a status</option>
            
            @foreach ($statuses as $status)
                <option value="{{ $status['id'] }}" 
                @if ($project->status_id === $status['id'])) 
                    {{ 'selected' }}
                @endif
                >{{$status['name']}}</option>
            @endforeach
        </select>
        <a href="/statuses/create">Add new status</a>
    </div>
</div>

<div class="long_field_date">
       @include('blocks.date', [
        'name_date' => 'start_date', 
        'legend' => 'Start date'] )
</div>

<div class="long_field_date">
    @include('blocks.date', [
        'name_date' => 'finish_date', 
        'legend' => 'Finish date'] )
</div>

<div class="">
    <input type="submit" class="btn" value="{{ $btnText }}" name="save"/>
</div>

    
    