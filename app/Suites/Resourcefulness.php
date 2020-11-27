<?php 
namespace App\Suites;

use App\Models\Resource;
use App\Models\ResourceType;

trait Resourcefulness{

    public function value(ResourceType $type){
        
        $resource =  new Resource([
            'type_id' => $type->id,
        ]);
        
        return $this->resourceful()->save($resource);
        
    }
    
    public function resourceful(){
        return $this->morphOne(Resource::class,'valuable');
    }
    
    public function isResource(){
        
        return !! $this->resourceful()
            ->count();
    }
    
    public function devalue(ResourceType $type){
        
        $this->resourceful()
            ->where('type_id', $type->id)
            ->delete();
    }
    
    public function toggleCredit(ResourceType $type){
    	
    	if ($this->isResource()){
    		return $this->devalue($type);
    	}
    	
    	return $this->value($type);
    }
    
}
?>