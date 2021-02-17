<?php

namespace App\Listeners;

use App\Events\DeliverableDatesChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Project;
use App\Models\Deliverable;

class ProjectProcess
{
    
    private $project;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DeliverableDatesChanged  $event
     * @return void
     */
    public function handle(DeliverableDatesChanged $event)
    {
        
        if ($event->attr === 'start_date'){
            $this->checkStartDate($event->deliverable);
        }
    }
    
    private function getProject(Deliverable $deliverable){
        
        $this->project = $deliverable->wbs->project;
    }
    
    private function checkStartDate(Deliverable $deliverable){
        
        $this->getProject($deliverable);
        
        if (empty($this->project->start_date)){

            $this->project->update(['start_date' => $deliverable->start_date]);
        }
    }
}
