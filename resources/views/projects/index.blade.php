@extends('layout')

@section('title','List of projects')

@section('content')
<a href="/projects/create" class="btn">Add project</a>
<main>
    
    <table>
        <caption>List of all projects</caption>
        <thead>
            <th>Title</th>
            <th>Status</th>
            <th>Start date</th>
            <th>Completion date</th>
        </thead>
        <tbody>
            
            @foreach ($projects as $project)
                <tr>
                    <td><a href="/projects/{{$project->id}}">{{$project->title}}</a></td>
                    <td>{{ $project->status['name'] }}</td>
                    <td>{{ $project->started }}</td>
                    <td>{{ $project->finished }}</td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
    
</main>
@endsection