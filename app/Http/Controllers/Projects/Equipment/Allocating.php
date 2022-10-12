<?php

namespace App\Http\Controllers\Projects\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class Allocating extends Controller
{
    public function save(Request $request, Project $project)
    {
        $resource = $request->validate([
            'equipment_id' => 'required',
            'type_id' => 'required'
        ]);

        $project->equipment->attach([
            $resource['equipment_id']=> ['type_id' => $resource['type_id']]
        ]);
    }
}
