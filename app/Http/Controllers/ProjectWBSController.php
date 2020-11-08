<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use Illuminate\Http\Request;
use App\Models\Deliverable;
use \Illuminate\Support\Facades\Auth;

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

        return view('projects.wbs.index',[
            'project'=> $project,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        if (!auth::check()) {
            abort(403);
        }
        
        return view('projects.wbs.create',[
            'project' => $project
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {    	
    	if (!auth::check()) {
    		abort(403);
    	}
    		
    	$request->validate(['title'=>'required']);
    		
    	$wbs = new WorkBreakdownStructure();
    	$project->initializeWBS($wbs);
    		
    	$deliverable = new Deliverable();
    	$deliverable->title = $request->title;
    		
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
    public function show(Project $project, WorkBreakdownStructure $wbs)
    {
        
    	return view('projects.wbs.edit',[
    		'project' => $project,
    		'wbs' => $wbs
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @param  \App\WorkBreakdownStructure  $workBreakdownStructure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, WorkBreakdownStructure $wbs)
    {
        if (!auth::check()) {
            abort(403);
        }
        
    	$request->validate(['title'=>'required']);
    	
    	$deliverable = new Deliverable();
    	$deliverable->title = $request->title;
    	
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
}
