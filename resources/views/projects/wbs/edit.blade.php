@extends('layout')

@section('title','Workbreakdown structure')

@section('content')

@include('show_err') 
    <main>
        <div class="wbs-section-panel">
            <form id="deliverable" 
                name="deliverable" 
                method="POST" 
                action="{{ $wbs->project->path() }}/deliverables"
                class="deliverable new">
            
                @method('PATCH')
                 
                @include('projects.wbs.deliverables.form',  [
                        'deliverable' => new App\Models\Deliverable,
                        'btnTitle' => 'Create'
                ])
            </form>  
            
           @include('projects.activity.history')
        </div>
 
         
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
                
                @foreach ($wbs->deliverables as $deliverable)
        
                    <tr tabindex='-1'>
                        <td data-template='recordID'>
                            <div class="flex_block one_row field">
                                {{ $deliverable->order }}
                            </div>
                        </td>
                        <td>
                            <div class="flex_block one_row field">
                                <a href="{{ $project->path() }}/deliverables/{{ $deliverable->id}}/edit"
                                    >{{$deliverable->title}}</a>
                            </div>
                        </td>
                        <td>
                            <div class="flex_block one_row field">
                                {{ $deliverable->cost }}
                            </div>
                        </td>
                        <td>
                            <div class="flex_block one_row field">
                                {{ $deliverable->start_date }}
                            </div>
                        </td>
                        <td>
                            <div class="flex_block one_row field">
                                {{ $deliverable->end_date }}
                            </div>
                        </td>
                    </tr>
                
                @endforeach
            
            </tbody>
        
        </table>
    </main> 

@endsection