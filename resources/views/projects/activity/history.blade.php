<section class="history">
    @foreach ($wbs->activityRecords as $activity)
    <ul>
        @if ($activity->description!=='created' &&
            $activity->description!=='updated')
            
            <li>
                @if (!empty($activity->changes))
                    @include("projects.activity.{$activity->description}",
                    [
                        'activity' => $activity,
                        'changes' => key($activity->changes['before'])
                    ])
                @else   
                    @include("projects.activity.{$activity->description}",[
                        'activity' => $activity
                    ])
                @endif
            </li>
        @endif
    </ul>
    @endforeach
</section> 