<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Equipment;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\ResourceType;

class ProjectEquipmentController extends Controller
{
    /**
     * Display a listing of project equipment.
     *
     * @param $request - \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project, Request $request)
    {        
        
        $validated = $request->validate([
            'type' => 'nullable|regex:/^(\w+\-*)+$/i',
            'name' => 'nullable|string'
        ]);
        
        $types = ResourceType::all();
        
        /** @todo - combine slug and all types query */
        
        $type = (!empty($validated['type']) ? ResourceType::filterSlug($validated['type'])->first()->id: null);
        $name = (!empty($validated['name']) ? $validated['name']: null);
        
        $resources = $project->resources()->filter(Equipment::class,compact('type','name'))->get();

        return view('projects.resources.equipment.index', 
                compact(['project', 'resources','types']));
    }
}
