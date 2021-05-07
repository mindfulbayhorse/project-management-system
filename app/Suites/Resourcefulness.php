<?php 
namespace App\Suites;

use App\Models\Resource;
use App\Models\Project;
use App\Models\ResourceType;

trait Resourcefulness{
    
    public function isResource(){
        
        return !! $this->resourceful()
            ->count();
    }
    
    public function withdraw(Project $project){
        
        return $this->resourceful()->where('project_id', $project->id);
    }
    
    public function resourceful()
    {
        
        return $this->morphMany(Resource::class,'valuable', 'valuable_type', 'valuable_id', 'id');
    }
    
    public function assignTo(Project $project, $typeId)
    {
        $this->resourceful()->updateOrCreate([
            'project_id' => $project->id,
            'resource_type_id' => $typeId
        ]);
    }
    
    public function isAssignedTo(Project $project)
    {
        
        return (bool) $this->resourceful()
            ->where('project_id', $project->id)
            ->count();
    }
    
}
?>