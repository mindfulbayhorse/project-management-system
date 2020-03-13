<?php

namespace App\Http\Controllers;

use App\Deliverable;
use App\Project;
use Illuminate\Http\Request;

class DeliverableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project, Deliverable $deliverable)
    {
        $wbs = [];
        if ($project->deliverables->count()) $wbs = $project->deliverables;
        
        return view('projects.show',[
            'project'=> $project,
            'deliverable'=> $deliverable,
            'wbs'=> $wbs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, Request $request)
    {    
        
        $attr = $this->validateFields($request);
        
        $project->addDeliverable($attr);
        
        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Deliverable $deliverable)
    {
        $wbs = [];
        if ($deliverable->children->count()) $wbs = $deliverable->children;

        return view(
            'projects.show',[
                'project'=> $project,
                'deliverable'=> $deliverable,
                'wbs'=> $wbs
            ]
        );
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
        $fields = $this->validateFields($request);
        
        $deliverable->update($fields);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @param  \App\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Deliverable $deliverable)
    {
        //
    }
    
    
    /*
     * Request validaing process
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function validateFields(Request $request)
    {
        return request()->validate([
            'title'=>'required',
            'end_date' => 'nullable|date_format:Y-m-d',
            'order' => 'nullable',
            'cost' => 'nullable',
            'parent_id' => 'nullable'
        ]);
    }
}
