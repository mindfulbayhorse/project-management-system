<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Equipment;
use App\Models\ResourceType;

class EquipmentAssignment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $equipment = Equipment::all();
        $typesEquipment = ResourceType::all();
        
        return view('projects.resources.assign', [
            'equipment' => $equipment,
            'project' => $project,
            'types' => $typesEquipment
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'equipment_id' => 'required',
            'type_id' => 'required',
        ]);
        
        $equipment = Equipment::find($validated['equipment_id']);
        $equipment->assignTo($project, $validated['type_id']);
        
        redirect(route('projects.equipment.index', ['project' => $project]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
