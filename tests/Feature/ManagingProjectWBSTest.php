<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Project;
use \App\WorkBreakdownStructure;
use \App\Deliverable;
use Facades\Tests\Setup\ProjectFactory;
use Facades\Tests\Setup\DeliverableFactory;

class ManagingProjectWBSTest extends TestCase
{
	use Refreshdatabase, WithFaker;
	
	private $project;
	private $wbs;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->project = ProjectFactory::create();
		
		$this->wbs = factory(WorkBreakdownStructure::class)->create([
			'project_id' => $this->project->id
		]);
		
	}    
    
    /** @test */
    public function first_level_deliverable_must_have_a_title(){
    	
        $this->signIn();
        
        $deliverable = DeliverableFactory::withTitle('')->new();
    	
    	$this->call('PATCH', $this->wbs->path(), $deliverable)
    		->assertSessionHasErrors('title');
    
    }
    
    /** @test */
    public function guests_cannot_initiate_wbs()
    {
        
        $deliverable = DeliverableFactory::new();
        
        $this->get($this->project->path().'/wbs/create')->assertStatus(403);
        $this->post($this->project->path().'/wbs', $deliverable)->assertStatus(403);
        
        $this->assertDatabaseMissing('deliverables', $deliverable);
    }
    
    /** @test */
    public function guests_cannot_add_new_first_level_deliverables()
    {
        
        $deliverable = DeliverableFactory::new();
        
        $this->patch(
            $this->wbs->path(),
            $deliverable
        )->assertStatus(403);
        
        $this->assertDatabaseMissing('deliverables', $deliverable);
            
    }
    
    /** test */
    public function wbs_is_initialized_after_project_is_created(){
        
        $this->project = ProjectFactory::create();
        
        $this->assertCount(1, $project->wbs);
        
    }
}
