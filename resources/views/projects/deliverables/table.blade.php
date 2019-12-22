@if ($project->deliverables->count())
    
    <table>
        <caption>Work Breakdown structure</caption>
        <thead>
            <th>Ordinal number</th>
            <th>Title</th>
            <th>Cost</th>
            <th>Start date</th>
            <th>End date</th>
        </thead>
        <tbody>
            
            @foreach ($project->deliverables as $deliverable)
                <tr>
                    <td>{{$loop->index}}</td>
                    <td><a href="/projects/{{$project->id}}/deliverables/{{$deliverable->id}}">{{$deliverable->title}}</a></td>
                    <td>{{ $deliverable->cost }}</td>
                    <td>{{ $deliverable->start_date }}</td>
                    <td>{{ $deliverable->end_date }}</td>
                </tr>
            @endforeach
        </tbody>
    
    </table>

@endif