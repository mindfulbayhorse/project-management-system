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
        
        return $this->morphOne(Resource::class,'valuable', 'valuable_type', 'valuable_id', 'id');
    }
    
    public function assignTo(Project $project, $typeId)
    {
        $this->valuable()->updateOrCreate([
            'project_id' => $project->id,
            'type_id' => $typeId
        ]);
    }
    
    public function isAssignedTo(Project $project)
    {
        
        return (bool) $this->valuable()
            ->where('project_id', $project->id)
            ->count();
    }
    
}
?>