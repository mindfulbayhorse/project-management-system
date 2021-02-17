<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Deliverable;

class DeliverableDatesChanged
{
    use Dispatchable, SerializesModels;

    public $deliverable;
    public $attr;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Deliverable $deliverable, string $attr)
    {
        $this->deliverable = $deliverable;
        $this->attr = $attr;
    }

}
