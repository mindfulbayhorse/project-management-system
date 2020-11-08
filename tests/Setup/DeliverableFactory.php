<?php 
namespace Tests\Setup;

use App\Deliverable;
use App\WorkBreakdownStructure;

class DeliverableFactory{
	
	private $attributes  = [];
	public $user;
	
	public function withTitle(string $title){
		
		$this->attributes['title'] = $title;
		
		return $this;
	}
	
	public function withinWBS(int $wbs){
	    
	    $this->attributes['wbs_id'] = $wbs;
	    
	    return $this;
	}

	public function create(){
		
		return factory(Deliverable::class)->create($this->attributes);
	}
	
	public function new(){
		
	    return factory(Deliverable::class)->raw($this->attributes);
	}
}