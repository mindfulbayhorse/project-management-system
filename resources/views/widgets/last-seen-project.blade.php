@if ($lastProject)

    {{$title}}: 
    <a href="@php 
            echo route('projects.show',['project'=>$lastProject]) 
        @endphp">{{ $lastProject->title }}</a>

@endif