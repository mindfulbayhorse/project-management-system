<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliverable;

class DeliverableAsPackageController extends Controller
{
    public function store(Deliverable $deliverable)
    {

        $deliverable->makeAsPackage(true);
        
        return back();
    }
    
    public function destroy(Deliverable $deliverable)
    {
        
        $deliverable->makeAsPackage(false);
        
        return back();
    }
}
