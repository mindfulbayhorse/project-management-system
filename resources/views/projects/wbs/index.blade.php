@extends('layout')

@section('title','List of project wbs')
@section('content')
<a href="{{$project->path()}}/wbs/create">Create new</a>
<main>
    
    <table>
        <caption>List of all project work breakdown structure</caption>
        <thead>
            <th>ID</th>
            <th>Creating date</th>
            <th>Changing date</th>
            <th>Actual state</th>
        </thead>
        <tbody>
            @if ($project->wbs->count() > 0)

                @foreach ($project->wbs as $wbs)
                    <tr>
                        <td><a href={{$wbs->path()}}>{{ $wbs->id }}</a></td>
                        <td>{{$wbs->created_at}}</td>
                        <td>{{$wbs->updated_at}}</td>
                        <td>{{$wbs->actual}}</td>
                    </tr>
                @endforeach
           
           @endif
            
            
        </tbody>
    
    </table>
<p>Total: {{ $project->wbs->count() }}</p>  
</main>
@endsection