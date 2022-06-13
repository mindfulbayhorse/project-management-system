<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return view('projects.index', [
            'projects' => Project::latest('updated_at')
                ->filter(request(['status','title']))
                ->with(['status','team', 'wbs' => function ($query) {
                    $query->where('actual', '=', '1');
                }])->paginate(2)->withQueryString(),
            'currentView' => ( $request->input('showby') ? $request->input('showby') : 'cards'),
            'viewChoice' => [
                'cards' => 'By cards',
                'table' => 'By table'
            ]
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create', [
            'statuses' => $this->listStatuses()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = auth()->user()->projects()->create($request->validated());
        
        return redirect(route('projects.edit',['project' =>$project]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
        $this->authorize('show', $project);
        session(['last_project'=> $project->id]);
        
        return view('projects.info', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        
        return view('projects.edit',[
            'project'=>$project,
            'statuses' => $this->listStatuses()
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
             
        $project->update($request->validated());
         
        return redirect($project->path());
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
        
        return redirect(route('projects.index'));
    }
    
    /*
     * get list of all statuses
     */    
    private function listStatuses() {
        
        return Status::all()->toArray();
        
    }
}
