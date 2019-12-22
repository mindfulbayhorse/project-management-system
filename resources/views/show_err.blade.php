@if ($errors->any())
    <div class="err_info">    
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif