@extends('layout')

@section('title', "Project's equipment")

@section('content')
<a href="{{ $project->path() }}/resources/equipment/assign">Choose an equipment</a>
<main>
    @if ($project->resources->count() > 0)
        <table>
            <caption>Project equipment</caption>
            <thead>
                <th>Title</th>
            </thead>
            <tbody>
    
                @foreach ($project->resources as $resource)
                    <tr>
                        <td></td>
                    </tr>
                @endforeach
                
            </tbody>
        
        </table>
    @else
        Project has no assigned equipment yet
    @endif
<p>Total: {{ $project->resources->count() }}</p>  
</main>
@endsection