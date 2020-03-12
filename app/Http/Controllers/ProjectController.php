<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Status;

class ProjectController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->listStatuses();
        return view('projects.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $this->validateFields($request);
        
        Project::create($fields);
        
        return redirect('/projects/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //dd($this->listStatuses());
        
        return view('projects.edit',[
            'project'=>$project,
            'statuses' => $this->listStatuses()
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        
        $fields = $this->validateFields($request);
             
        $project->update($fields);
         
        return redirect('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        
        return redirect('/projects');
    }
    
    /*
     * Request validaing process
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function validateFields(Request $request)
    {
        return $request->validate([
            'title'=>'required',
            'started' => 'nullable|date_format:Y-m-d',
            'status_id' => 'nullable'
        ]);
    }
    
    /*
     * get list of all statuses
     */    
    private function listStatuses() {
        
        return Status::all()->toArray();
        
    }
}
