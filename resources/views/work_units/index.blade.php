@extends('layout')

@section('title','List of statuses')

@section('content')
<a href="/work_units/create" class="btn">Add work unit</a>
<main>
    
    <table>
        <caption>List of all work units to use throught the system</caption>
        <thead>
            <th>Title</th>
            <th>Description</th>
        </thead>
        <tbody>
            
            @foreach ($workUnits as $unit)
                <tr>
                    <td><a href="/work_units/{{$unit->id}}">{{$unit->name}}</a></td>
                    <td>{{ $unit->description }}</td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
    
</main>
@endsection