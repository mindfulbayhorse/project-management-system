<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\ResourceType;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipment = Equipment::all();
        
        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipment.create', ['types' => $this->listTypes()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipment = Equipment::create($request->validate([
            'name' => 'required',
            'resource_type_id' => 'nullable',
            'model' => 'required',
            'cost' => 'required|numeric'
        ]));
        
        return redirect(action([get_class($this), 'edit'], 
                ['equipment' => $equipment]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.info', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', [
            'equipment' => $equipment,
            'types' => $this->listTypes()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
    
    
    /*
     * get list of all statuses
     */
    private function listTypes() {
        
        return ResourceType::all()->toArray();
        
    }
    
}
