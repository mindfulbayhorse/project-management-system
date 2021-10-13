<h2>{{ $title}}</h2>

<ul>
@foreach($items as $item)
    <li>{{ $item }}</li>
@endforeach
</ul>