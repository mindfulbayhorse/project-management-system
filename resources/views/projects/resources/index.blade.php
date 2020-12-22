@extends('layout')

@section('title','List of project resources')
@section('content')
<a href="{{ $project->path() }}/resources/equipment">add new resource</a>
<main>
    @if ($project->resources->count() > 0)
        <table>
            <caption>List of all project resources</caption>
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
        There have been no resources added yet.
    @endif
<p>Total: {{ $project->resources->count() }}</p>  
</main>
@endsection