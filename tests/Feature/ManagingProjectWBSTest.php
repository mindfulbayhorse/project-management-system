<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;

class ManagingProjectWBSTest extends TestCase
{
	use Refreshdatabase, WithFaker;
	
	private $project;
	private $wbs;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->project = Project::factory()->create();
		
		$this->wbs = WorkBreakdownStructure::factory()->create([
			'project_id' => $this->project->id
		]);
		
	}    
    
    /** @test */
    public function first_level_deliverable_must_have_a_title(){
    	
        $this->signIn();
        
        $deliverable = Deliverable::factory()->raw(['title'=>'']);
    	
    	$this->call('PATCH', $this->wbs->path(), $deliverable)
    		->assertSessionHasErrors('title');
    
    }
    
    /** @test */
    public function guests_cannot_initiate_wbs()
    {
        
        $deliverable = Deliverable::factory()->raw();
        
        $this->get($this->project->path().'/wbs/create')
            ->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->post($this->project->path().'/wbs', $deliverable)
            ->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->assertDatabaseMissing('deliverables', $deliverable);
    }
    
    /** @test */
    public function guests_cannot_add_new_first_level_deliverables()
    {
        
        $deliverable = Deliverable::factory()->raw();
        
        $this->patch(
            $this->wbs->path(),
            $deliverable
       )->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->assertDatabaseMissing('deliverables', $deliverable);
            
    }
    
    /** test */
    public function wbs_is_initialized_after_project_is_created(){
        
        $project = Project::factory()->create();
        
        $this->assertCount(1, $project->wbs);
        
    }
}
