<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ResourceType;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $request - \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project, Request $request)
    {
        $resources = $project->resources();
        return view('projects.resources.index', compact(['project', 'resources']));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @param \App\Models\ResourceType $type
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, ResourceType $type)
    {
        $project = $project->with('resources', function($query) use ($type){
            $query->where('type_id', $type->id);
        })->get();
        
        return view('projects.resources.types.index', compact(['project', 'type']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectResource  $projectResource
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
     * @param  \App\ProjectResource  $projectResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectResource $projectResource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectResource  $projectResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectResource $projectResource)
    {
        //
    }
}
