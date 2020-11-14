<?php

namespace App\Http\Controllers;

use App\Models\ProjectTeam;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        
        return view('projects.team.index', compact('project'));
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
     * @param  \App\Models\Project  $project
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project  $project)
    {
        $attr = $request->validate(['user_id'=>'required']);
        if (!$attr) return;
        
        $project->addMember(User::find($attr['user_id']));
        
        return redirect($project->path().'/team');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectTeam  $team
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectTeam $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\ProjectTeam  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectTeam $team, Project  $project)
    {
        $userList = User::all();
        
        return view('projects.team.add_member', [
            'project' => $project,
            'users' => $userList
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectTeam  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectTeam $team)
    {
        //
    }
}
