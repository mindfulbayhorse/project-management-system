<section class="history">
    <ul>
        @foreach ($wbs->activityRecords as $activity)
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
   	@endforeach
    </ul>
</section> 