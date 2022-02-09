<x-master>

    @section('title','List of {{ $type->name }} for {{$project->name}}')
    
    @foreach ($project->resources as $resource)
    
        <tr>
            <td></td>
        </tr>
        
    @endforeach