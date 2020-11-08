<section class="history">
    @foreach ($wbs->activityRecords as $activity)
    <ul>
        @if ($activity->description!=='created')
            <li>@include("projects.activity.{$activity->description}")</li>
        @endif
    </ul>
    @endforeach
</section> 