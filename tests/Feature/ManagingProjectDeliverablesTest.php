<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Project;
use App\WorkBreakdownStructure;
use App\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ManagingProjectDeliverablesTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
	private $project;
	private $wbs;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->project = factory(Project::class)->create();
		
		$this->wbs = $this->project->wbs()->create(
						
			factory(WorkBreakdownStructure::class)->raw()
		
		);
	
	}
	
    
    /** @test */
    public function it_can_be_updated()
    {
    	$this->withoutExceptionHandling();
    	
    	$deliverable = factory(Deliverable::class)->make();
    	
    	$savedDeliverable = $this->wbs->add($deliverable);
    	
    	$changedTitle = [
    		'title' => $this->faker->sentence(),
    		'package' => true
    	];
    	
    	$this->patch(
    		$this->project->path().'/deliverables/'.$savedDeliverable->id,
    		$changedTitle
    	);
    	
    	$this->assertDatabaseHas('deliverables', [
    		'title' => $changedTitle['title'],
    		'package'=>true,
    		'id' => $savedDeliverable->id
    	]);
    	
    }
}
