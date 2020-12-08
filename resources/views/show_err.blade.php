
@if ($errors->{$bag ?? 'default'}->any())
    <div class="err_info">    
        @foreach($errors->{$bag ?? 'default'}->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif