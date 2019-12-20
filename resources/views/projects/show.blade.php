@extends('layout')

@section('title','Project')

@section('content')

<main>
    <h1>{{$project->title}}</h1>
        
        <div class="flex_block one_row">
            <label for="status">Status:</label>
            <p>{{$project->status}}</p>
        </div>  
        
        <div class="flex_block one_row">
            <label for="started">Start date:</label>
            <p>{{$project->started}}</p>
        </div> 
        
        <div class="flex_block one_row">
            <label for="finished">End date:</label>
            <p>{{$project->finished}}</p>
        </div>   
        
        <a href="/projects/{{$project->id}}/edit" class="btn">Edit project</a>  
        
        @if($project->deliverables->count())
            <table class="list_table">
                <tbody>
                    
                    @foreach($project->deliverables as $deliverable)
                    
                        <tr>
                            <td>{{ $deliverable->title }}</td>
                            <td>{{ $deliverable->start_date }}</td>
                            <td>{{ $deliverable->end_date }}</td>
                            <td>{{ $deliverable->cost }}</td>
                            <td>{{ $deliverable->parent_id }}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            
            </table>
        @endif   
        
        <a href="/projects/{{$project->id}}/deliverables/">Work breakdown structure</a>      
    
</main>
@endsection