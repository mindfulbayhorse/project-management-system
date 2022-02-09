<x-master>

    @php $title = 'List of equipment for '.$project->title;@endphp
    @section('title',$title)
    
   @php
        $buttonText = 'Types' 
   @endphp
    <x-forms.dropdown.dropdown :id="'filter_type'" :buttonText="$buttonText">
        @foreach($types as $type)
            @php
                $link = route('projects.equipment.index',[
                'project'=>$project], false).'?type='.$type->slug
            @endphp
            <x-forms.dropdown.item 
                href="{{ $link }}" 
                :selected="request()->is($link)">{{ $type->name}}</x-forms.dropdown.item>
        @endforeach
    </x-forms.dropdown.dropdown>
    
     <form class="filter" method="GET">
        <input type="text" name="name" value="{{ request('name') }}" />
        <button>Search</button>
    </form>
    
    <table>
        <tbody>
             @foreach($resources as $equipment)
                <tr>
                    <td><a 
                        href="{{ route('equipment.show',$equipment->valuable) }}">{{$equipment->valuable->name}}</a>
                     </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-master>