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
            'model' => 'nullable|string'
        ]);
        //dd(compact('type','name'));
        $types = ResourceType::all();
        
        /** @todo - combine slug and all types query */
        
        $type = (!empty($validated['type']) ? $validated['type']: null);
        $name = (!empty($validated['model']) ? $validated['model']: null);
        
        $resources = $project->resources()->with(['valued' => fn ($morphTo)=>
            $morphTo->morphWith([
                Equipment::class => ['valuable']
            ])])->filter(Equipment::class,compact('type','name'))
        ->get();

        
        return view('projects.resources.equipment.index', 
                compact(['project', 'resources','types']));
    }
}
