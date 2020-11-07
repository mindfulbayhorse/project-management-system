<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Project;
use \App\WorkBreakdownStructure;
use \App\Deliverable;

class ProjectWBSTest extends TestCase
{
	use RefreshDatabase;
	
    private $project;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->signIn();
		
		$this->project = factory(Project::class)->create();
		
	}
    
	/** @test */
    public function project_can_have_initial_wbs()
    {
    	
        $deliverable = factory(Deliverable::class)->raw(['title' => 'Content']);
        
        $this->post($this->project->path().'/wbs', $deliverable);
        
        $wbs = factory(WorkBreakdownStructure::class)->make();
        
        $this->project->initializeWBS($wbs);
        
        $this->get($this->project->wbs()->first()->path())->assertSee('Content');

    }
}
