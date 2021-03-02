<form action="{{ $project->path() }}" method="POST">

    @csrf 
    @method('DELETE')
    
    <input type="submit" 
        value="Delete" 
        class="delete"
        name='delete' />
    
</form>