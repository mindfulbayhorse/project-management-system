<?php 
namespace Tests\Setup;

use App\WorkBreakdownStructure;

class WorkBreakdownStructureFactory{
	
	private $attributes  = [];
	public $user;
		
	public function withProject(string $project){
	    
	    $this->attributes['project_id'] = $project;
	    
	    return $this;
	}

	public function create(){
		
	    return factory(WorkBreakdownStructure::class)->create($this->attributes);
	}
	
	public function new(){
		
	    return factory(WorkBreakdownStructure::class)->raw($this->attributes);
	}
}