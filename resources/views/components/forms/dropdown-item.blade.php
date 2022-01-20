@props(['selected' => false])

@php
 if ($selected) $class .= 'selected'
@endphp

<a {{ $attributes(['class'=> '']) }}>{{ $slot }}</a>