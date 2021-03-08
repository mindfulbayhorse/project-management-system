<table>
  <caption>Work Breakdown structure</caption>
  <thead>
    <tr>
      @if (isset($form))
        <td></td>
      @endif
      <th scope="col">Title</th>
      <th scope="col">Start date (dd/mm/yy)</th>
      <th scope="col">Finish date (dd/mm/yy)</th>
      <th scope="col">Cost ($)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($wbs->deliverables as $deliverable)
        
        <tr tabindex='-1'>
            @if (isset($form))
                <td>
                    <input class="form-check-input" 
                            type="radio" 
                            value="{{ $deliverable->id }}" 
                            aria-label="..."
                            name="order"
                            form="{{ $form }}" />
                </td>
            @endif
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
