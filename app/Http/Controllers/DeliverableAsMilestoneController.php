<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliverable;

class DeliverableAsMilestoneController extends Controller
{
    public function store(Deliverable $deliverable)
    {
        
        $deliverable->makeAsMilestone(true);
        
        return back();
    }
    
    public function destroy(Deliverable $deliverable)
    {
        
        $deliverable->makeAsMilestone(false);
        
        return back();
    }
}
