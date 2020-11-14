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
    public function project_can_initialize_actual_wbs_by_new_deliverable()
    {
        $this->withoutExceptionHandling();
        
    	$title = $this->faker->sentence;
    	
        $deliverable = Deliverable::factory()->raw(['title'=>$title]);

        $this->followingRedirects()
            ->post($this->project->path().'/deliverables', $deliverable)
            ->assertSee($title);
        
        $this->assertCount(1, $this->project->wbs()->actual());

    }
}
