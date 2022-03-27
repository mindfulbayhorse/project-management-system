@php
    $buttonStatus = 'Status';
@endphp
<x-forms.dropdown.dropdown :id="'status_filter'" :buttonText="$buttonStatus">
    @foreach($statuses as $status)
        @php
            $link = route('projects.index',[], false).'?status='.$status->id
        @endphp
        <x-forms.dropdown.item 
            href="{{ $link }}" 
            :selected="request()->is($link)">{{ $status->name }}</x-forms.dropdown-item>
    @endforeach
</x-forms.dropdown>