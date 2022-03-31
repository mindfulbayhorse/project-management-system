@php
    $buttonStatus = 'Status';
@endphp
<x-forms.dropdown.dropdown :id="'status_filter'" :buttonText="$buttonStatus">
    @foreach($statuses as $status)
        @php
            $link = route('projects.index',[], false).'?status='.$status->id;
            $filter = http_build_query(request()->except('status'));
            $params = '';
            if ($filter) $params = '&'.$filter;
        @endphp
        <x-forms.dropdown.item 
            href="{{ $link }}{{ $params }}" 
            :selected="request()->is($link)">{{ $status->name }}</x-forms.dropdown-item>
    @endforeach
</x-forms.dropdown>