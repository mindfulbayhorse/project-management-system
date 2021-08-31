<?php 

namespace App\Http\Widgets;

use App\Models\Project;
use Illuminate\Http\Request;

class LastSeenProject extends Widget{
    
    public $lastProject;
    
    public $title = 'Last watched project';
    
    public function __construct(Request $request){
        
        $this->lastProject = Project::find($request->session()->get('last_project'));
    }

}