
@if ($errors->{$bug ?? 'default'}->any())
    <div class="err_info">    
        @foreach($errors->{$bug ?? 'default'}->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif