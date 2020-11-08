<?php

namespace App\Observers;

use App\WorkBreakdownStructure;

class WorkBreakdownStructureObserver
{
    /**
     * Handle the work breakdown structure "created" event.
     *
     * @param  \App\WorkBreakdownStructure  $wbs
     * @return void
     */
    public function created(WorkBreakdownStructure $wbs)
    {
        $wbs->recordActivity('WBS is created');
    }  

    /**
     * Handle the work breakdown structure "updated" event.
     *
     * @param  \App\WorkBreakdownStructure  $wbs
     * @return void
     */
    public function updated(WorkBreakdownStructure $wbs)
    {
        $wbs->recordActivity('WBS is updated');
    }

    /**
     * Handle the work breakdown structure "deleted" event.
     *
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return void
     */
    public function deleted(WorkBreakdownStructure $workBreakdownStructure)
    {
        //
    }

    /**
     * Handle the work breakdown structure "restored" event.
     *
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return void
     */
    public function restored(WorkBreakdownStructure $workBreakdownStructure)
    {
        //
    }

    /**
     * Handle the work breakdown structure "force deleted" event.
     *
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return void
     */
    public function forceDeleted(WorkBreakdownStructure $workBreakdownStructure)
    {
        //
    }
}
