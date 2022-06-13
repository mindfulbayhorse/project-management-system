@php
    $buttonStatus = 'Status';
    $link = route('projects.index',[], false);
    $filter = http_build_query(request()->except('status','page'));
    $params = '';
    if ($filter) $params = '?'.$filter;
    $plucked =  $statuses->pluck('name', 'id');
    if(!empty($plucked[$currentStatus])){
        $buttonStatus = $plucked[$currentStatus];
    }
@endphp

            
<x-forms.dropdown.dropdown :id="'status_filter'" :buttonText="$buttonStatus">

    <x-forms.dropdown.item 
            href="{{ $link }}{{ $params }}" 
            :active="request()->has('status')">All</x-forms.dropdown-item>
            
    @foreach($statuses as $status)
        @php
            $link = route('projects.index',[], false).'?status='.$status->id;
            $filter = http_build_query(request()->except('status','page'));
            $params = '';
            if ($filter) $params = '&'.$filter;
        @endphp
        <x-forms.dropdown.item 
            href="{{ $link }}{{ $params }}" 
            :selected="request()->is($link)">{{ $status->name }}</x-forms.dropdown-item>
    @endforeach
</x-forms.dropdown>