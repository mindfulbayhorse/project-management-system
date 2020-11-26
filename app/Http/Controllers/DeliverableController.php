<?php

namespace App\Http\Controllers;

use App\Models\Deliverable;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\DeliverableRequest;

class DeliverableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\WorkBreakdownStructure  $wbs
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        
    	return view('projects.wbs.index',[
    		'project'=> $wbs,
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkBreakdownStructure  $wbs
     * @return \Illuminate\Http\Response
     */
    public function store(DeliverableRequest $request, Project $project)
    {
        $this->authorize('create', Deliverable::class);
        
        //$deliverable = new Deliverable($request->validated());
        
        
        $project->wbs()->actual()[0]->add($request->validated());
        
        //dd($project->wbs()->actual()[0]->deliverables);
        
        return redirect($project->wbs()->actual()[0]->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Deliverable $deliverable)
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
     * @param  App\Http\Requests\DeliverableRequest  $DeliverableRequest
     * @param  \App\Project  $project
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function update(DeliverableRequest $request, Project $project, Deliverable $deliverable)
    {
        $this->authorize('update', $deliverable);
        
        $deliverable->update($request->validated());
        
        $package = $request->has('package') ? 'makeAsPackage' : 'makeAsNotPackage';
        
        $deliverable->$package();
        
        $milestone = $request->has('milestone') ? 'makeAsMilestone' : 'makeAsNotMilestone';
        
        $deliverable->$milestone();
        
        return redirect($deliverable->path().'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\  $project
     * @param  \App\Models\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Deliverable $deliverable)
    {
        //
    }
}