<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Http\Requests\DeliverableRequest;
use App\Models\Deliverable;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use Carbon\Carbon;

class ProjectWBSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        if ($project->wbs()->count() === 1) {
            return view('projects.wbs.edit',[
                'project' => $project,
                'wbs' => $project->wbs()->actual()->first()
            ]);
        }
        
        return view('projects.wbs.index',[
            'project'=> $project,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $wbs = $project->wbs()->actual()->first();
        
        return view('projects.wbs.deliverables.create',[
            'project' => $project,
            'wbs' => $wbs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Requests\DeliverableRequest  $project
     * @return \Illuminate\Http\Response
     */
    public function store(DeliverableRequest $request, Project $project)
    {    	
        $this->authorize('create', Deliverable::class);
        
        $deliverable = new Deliverable($request->validated()); 
    		
    	$wbs = new WorkBreakdownStructure();
    	$project->initializeWBS($wbs);
    		
    	$wbs->add($deliverable);
    		
    	return view('projects.wbs.edit',[
    		'project' => $project,
    		'wbs' => $wbs
    	]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, WorkBreakdownStructure $wbs, Request $request)
    {
 
        $validated = $request->validate([
            'start_date' => 'nullable|date_format:U',
            'end_date' => 'nullable|date_format:U',
            ]);
        
        $start_date = $validated['start_date'] ?? null;
        
        $end_date = $validated['end_date'] ?? null;
        
        $filter = compact("start_date", "end_date");

        return view('projects.wbs.edit',[
    		'project' => $project,
    		'wbs' => $wbs,
            'deliverables' => Deliverable::filterDeliverables($filter, $wbs)
    	]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, WorkBreakdownStructure $wbs)
    {
        return view('projects.wbs.edit',[
             'project' => $project,
             'wbs' => $wbs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DeliverableRequest  $request
     * @param  \App\Project  $project
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function update(DeliverableRequest $request, Project $project, WorkBreakdownStructure $wbs)
    {
        $this->authorize('create', Deliverable::class);
        
        $deliverable = new Deliverable($request->validated());    	
        var_dump($deliverable);
    	$wbs->add($deliverable);
    	
    	return view('projects.wbs.edit',[
    		'project' => $project,
    		'wbs' => $wbs
    	]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, WorkBreakdownStructure $wbs)
    {
        //
    }
    
    public function validateFilter()
    {
        
    }
}
