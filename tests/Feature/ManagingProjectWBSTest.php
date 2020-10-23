<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Project;
use \App\WorkBreakdownStructure;
use \App\Deliverable;

class ManagingProjectWBSTest extends TestCase
{
	use Refreshdatabase, WithFaker;
	
	private $project;
	private $wbs;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->project = factory(Project::class)->create();
		
		$this->wbs = factory(WorkBreakdownStructure::class)->create([
			'project_id' => $this->project->id
		]);
		
	}    
    
    /** @test */
    public function first_level_deliverable_must_have_a_title(){
    	
        $this->signIn();
        
    	$deliverable = [
    		'title' => ''
    	];
    	
    	$this->call('PATCH', $this->wbs->path(), $deliverable)
    		->assertSessionHasErrors('title');
    
    }
    
    /** @test */
    public function guests_cannot_add_new_first_level_deliverables()
    {
        
        $deliverable = ['title' => $this->faker->sentence];
        
        $this->patch(
            $this->wbs->path(),
            $deliverable
        )->assertStatus(403);
        
        $this->assertDatabaseMissing('deliverables', $deliverable);
            
    }
}
