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
    
}
