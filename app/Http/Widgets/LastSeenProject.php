<?php 

namespace App\Http\Widgets;

use App\Models\Project;
use Illuminate\Http\Request;
use Projects\Widget\Widget;

class LastSeenProject extends Widget{
    
    public $lastProject;
    
    public $title = 'Last watched project';
    
    public function __construct(){
        
        $this->lastProject = Project::find(session('last_project'));
    }

}