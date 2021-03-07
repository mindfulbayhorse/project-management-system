<section class="history">
    <h4>History</h4>
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
    <div class="actions">
        <button>Undo</button>
        <button>Redo</button>
    </div>
</section> 