<?php 
namespace App\Suites;

use App\Models\Resource;
use App\Models\ResourceType;

trait Resourcefulness{

    public function value(){
        
        return $this->resourceful()->save(new Resource());
        
    }
    
    public function resourceful(){
        return $this->morphOne(Resource::class,'valuable');
    }
    
    public function isResource(){
        
        return !! $this->resourceful()
            ->count();
    }
    
    public function devalue(){
        
        $this->resourceful()->delete();
    }
    
    public function toggleCredit(){
    	
    	if ($this->isResource()){
    		return $this->devalue();
    	}
    	
    	return $this->value();
    }
    
}
?>