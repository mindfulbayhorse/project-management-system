<?php

namespace App\Http\Controllers;

use App\Models\ProjectResource;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Equipment;
use App\Models\ResourceType;

class ProjectResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        //$resources = $project->resources;
        
        return view('projects.resources.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectResource  $projectResource
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectResource $projectResource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectResource  $projectResource
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectResource $projectResource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectResource  $projectResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectResource $projectResource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectResource  $projectResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectResource $projectResource)
    {
        //
    }
    
    /**
     * Assign equipment to a project
     * @param Request $request
     * @param Project $project
     */
    public function assignEquipmentToProject(Request $request, Project $project)
    {
        $validated = $request->validate([
            'equipment_id' => 'required',
            'type_id' => 'required',
        ]);
        
        $equipment = Equipment::find($validated['equipment_id']);
        $type = ResourceType::find($validated['type_id']);
        
        $resource = $equipment->value($type);
        
        if (ProjectResource::where('project_id', $project->id)->where('resource_id', $resource->id)->get()->count() 
            ==0) {
                $project->assign($equipment);
            }
         
        redirect(route('projectEquipment', ['project' => $project]));
    }
    
    public function chooseEquipment(Project $project)
    {
        $equipment = Equipment::all();
        $typesEquipment = ResourceType::all();
        return view('projects.resources.assign', [
            'equipment' => $equipment,
            'project' => $project,
            'types' => $typesEquipment
        ]);
    }
}
