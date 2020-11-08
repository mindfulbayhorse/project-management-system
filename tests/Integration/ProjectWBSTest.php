<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Deliverable;

class ProjectWBSTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
    private $project;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->signIn();
		
		$this->project = Project::factory()->create();
		
	}
    
	/** @test */
    public function project_can_initialize_wbs_by_new_deliverable()
    {
        $this->withoutExceptionHandling();
        
    	$title = $this->faker->sentence;
    	
        $deliverable = Deliverable::factory()->raw(['title'=>$title]);

        $this->post($this->project->path().'/wbs', $deliverable);
        
        $this->project->refresh();
        
        $this->get($this->project->path().'/wbs/'.$this->project->wbs->last()->id)->assertSee($title);

    }
}
