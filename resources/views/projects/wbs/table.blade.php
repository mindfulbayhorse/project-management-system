<table>
  <caption>Work Breakdown structure</caption>
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Start date (dd/mm/yy)</th>
      <th scope="col">Finish date (dd/mm/yy)</th>
      <th scope="col">Cost ($)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($wbs->deliverables as $deliverable)
        
        <tr tabindex='-1'>
            <td>
                <a href="{{ $deliverable->path() }}">{{ $deliverable->title }}</a>
            </td>
            <td>
                {{ $deliverable->start_date }}
            </td>
            <td>
                {{ $deliverable->end_date }}
            </td>
            <td>
                {{ $deliverable->cost }}
            </td>
        </tr>
    
        @endforeach

    </tbody>
</table>
