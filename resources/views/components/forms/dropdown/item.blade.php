@props([
    'selected' => false,
    'active' => true
    ])

@php
    $class='';
    
 if ($selected) $class .= 'selected';
 if ($active) $class .= 'active';
@endphp

<a {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</a>