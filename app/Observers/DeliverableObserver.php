<?php

namespace App\Observers;

use App\Deliverable;

class DeliverableObserver
{
    /**
     * Handle the deliverable "created" event.
     *
     * @param  \App\Deliverable  $deliverable
     * @return void
     */
    public function created(Deliverable $deliverable)
    {
        $deliverable->recordActivity('Deliverable is created');
    }
    
    /**
     * Handle the deliverable "updated" event.
     *
     * @param  \App\Deliverable  $deliverable
     * @return void
     */
    public function updated(Deliverable $deliverable)
    {
        $deliverable->recordActivity('Deliverable is updated');
    }

    /**
     * Handle the deliverable "deleted" event.
     *
     * @param  \App\Deliverable  $deliverable
     * @return void
     */
    public function deleted(Deliverable $deliverable)
    {
        //
    }

    /**
     * Handle the deliverable "restored" event.
     *
     * @param  \App\Deliverable  $deliverable
     * @return void
     */
    public function restored(Deliverable $deliverable)
    {
        //
    }

    /**
     * Handle the deliverable "force deleted" event.
     *
     * @param  \App\Deliverable  $deliverable
     * @return void
     */
    public function forceDeleted(Deliverable $deliverable)
    {
        //
    }
}
