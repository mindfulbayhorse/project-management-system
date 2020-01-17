@extends('layout')

@section('title','List of statuses')

@section('content')
<a href="/statuses/create" class="btn">Add Status</a>
<main>
    
    <table>
        <caption>List of all statuses for project state</caption>
        <thead>
            <th>Title</th>
            <th>Description</th>
        </thead>
        <tbody>
            
            @foreach ($statuses as $status)
                <tr>
                    <td><a href="/statuses/{{$status->id}}">{{$status->name}}</a></td>
                    <td>{{ $status->description }}</td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
    
</main>
@endsection