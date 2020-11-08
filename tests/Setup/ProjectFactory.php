<?php 
namespace Tests\Setup;


use App\Project;
use App\User;
use App\WorkBreakdownStructure;
use App\Deliverable;

class ProjectFactory{
	
	public $user;
	private $attributes  = [];
	private $deliverablesCount = 0;
	
	public function managedBy(User $user){
		
		$this->user = $user;

		return $this;
	}
	
	public function withTitle(string $title){
		
		$this->attributes['title'] = $title;
		
		return $this;
	}
	
	public function withStartedDate($startDate){
	    
	    $this->attributes['started'] = $startDate;
	    
	    return $this;
	}

	public function create(){
		
		$this->attributes["user_id"] = $this->user ?? factory(User::class);
		
		return factory(Project::class)->create($this->attributes);
	}
	
	public function newAttributes(){
		
		$this->attributes["user_id"] = $this->user ?? factory(User::class);
		
		return factory(Project::class)->raw($this->attributes);
	}
	
	public function withDeliverables($count){
		
		$this->deliverablesCount = $count;
		
		return deliverableAttributes();
	}
	
	public function deliverableAttributes(){
		
		factory(Deliverable::class, $this->deliverablesCount)->make();
	}
}