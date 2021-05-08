<?php

namespace App\Http\Controllers;

use App\Models\Deliverable;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\DeliverableRequest;
use App\Models\WorkBreakdownStructure;

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
    	    'project'=> $project
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
        $wbs = $project->wbs()->actual()->first();
        
        return view('projects.wbs.deliverables.create',[
            'project'=> $project,
            'wbs' => $wbs
        ]);
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
        
        Deliverable::create($request->validated());
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Deliverable $deliverable)
    {
        return view('projects.wbs.deliverables.show',[
            'project' => $project,
            'deliverable' => $deliverable
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Deliverable $deliverable)
    {
        $wbs = $project->wbs()->actual()->first();
        
    	return view('projects.wbs.deliverables.edit',[
    		'project' => $project,
    	    'wbs' => $wbs,
    		'deliverable' => $deliverable
    	]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\DeliverableRequest  $DeliverableRequest
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function update(DeliverableRequest $request, Project $project, Deliverable $deliverable)
    {
        $this->authorize('update', $deliverable);
        
        $deliverable->update($request->validated());
        
        return back();
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
