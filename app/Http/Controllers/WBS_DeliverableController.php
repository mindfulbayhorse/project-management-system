<?php

namespace App\Http\Controllers;

use App\Deliverable;
use App\project;
use Illuminate\Http\Request;

class WBS_DeliverableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function index(WorkBreakdownStructure $wbs)
    {
    	return view('projects.wbs.index',[
    		'project'=> $wbs,
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function create(WorkBreakdownStructure $workBreakdownStructure)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, WorkBreakdownStructure $workBreakdownStructure)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function show(WorkBreakdownStructure $workBreakdownStructure, Deliverable $deliverable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Deliverable $deliverable)
    {
    	return view('projects.wbs.deliverables.edit',[
    		'project' => $project,
    		'deliverable' => $deliverable
    	]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Deliverable $deliverable)
    {

        $deliverable->update([
        	'title' => $request->title,
        	'package' => $request->boolean('package')
        ]);
        
        return redirect($project->path().'/deliverables/'.$deliverable->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkBreakdownStructure $workBreakdownStructure, Deliverable $deliverable)
    {
        //
    }
}
