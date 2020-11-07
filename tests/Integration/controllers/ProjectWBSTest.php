<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Project;
use \App\WorkBreakdownStructure;
use \App\Deliverable;
use Facades\Tests\Setup\ProjectFactory;
use Facades\Tests\Setup\DeliverableFactory;

class ProjectWBSTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
    private $project;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->signIn();
		
		$this->project = ProjectFactory::create();
		
	}
    
	/** @test */
    public function project_can_initialize_wbs_by_new_deliverable()
    {
        $this->withoutExceptionHandling();
        
    	$title = $this->faker->sentence;
    	
        $deliverable = DeliverableFactory::withTitle($title)
            ->new();

        $this->post($this->project->path().'/wbs', $deliverable);
        
        $this->project->refresh();
        
        $this->get($this->project->path().'/wbs/'.$this->project->wbs->last()->id)->assertSee($title);

    }
}
