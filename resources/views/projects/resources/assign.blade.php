@extends('layout')

@section('title','List of all equipment')
@section('content')
<h2>{{ $project->title }}</h2>
<main>
    @if ($equipment->count() > 0)
        <form>
             <table>
                <caption>List of all equipment</caption>
                <thead>
                    <th></th>
                    <th>Title</th>
                    <th>Type</th>
                </thead>
                <tbody>
        
                    @foreach ($equipment as $item)
                        <tr>
                            <td>
                                <input type="checkbox"
                                    name="equipment_id[]"
                                    value="{{ $item->id }}"
                                    />
                            </td>
                            <td>
                                <a href="{{ $item->path() }}" 
                                    class="title">{{ $item->name }}</a>
                            </td>
                            <td>
                                <select>
                                    @forelse ($types as $type)
                                        <option name="{{type_id[$item->id]}}" 
                                            value={{ $type->id }}>{{ $type->name }}</select>
                                    @empty
                                        <option>Choose type</option>
                                    @endforelse
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            
            </table>
            <p>Total: {{ $equipment->count() }}</p>
            <input type="submit"
                value="Assign" />
        </form>
       
    @else
        Equipment list is empty
    @endif
  
</main>
@endsection