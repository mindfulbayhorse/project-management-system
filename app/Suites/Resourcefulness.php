<?php 
namespace App\Suites;

use App\Models\Resource;
use App\Models\Project;
use App\Models\ResourceType;

trait Resourcefulness{
    
    public function isResource(){
        
        return !! $this->valuable()
            ->count();
    }
    
    public function withdraw(Project $project){
        
        return $this->valuable()->where('project_id', $project->id);
    }
    
    public function valuable()
    {
        return $this->morphToMany(Project::class, 'valuable', 'resources','valuable_id','project_id')->withPivot('type_id');
    }
    
    public function assignTo(Project $project, $typeId)
    {

        $this->valuable()->attach($project->id, ['type_id' => $typeId]);
    }
    
    public function isAssignedTo(Project $project)
    {
        
        return (bool) $this->valuable()
            ->where('project_id', $project->id)
            ->count();
    }
    
}
?>