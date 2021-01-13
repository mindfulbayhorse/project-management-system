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
		
		$this->wbs = WorkBreakdownStructure::factory()
		    ->hasDeliverables(1)
		    ->for(Project::factory(), 'project')
		    ->create();
		
		$this->wbs->actualize();
		
	}    
    
    /** @test */
    public function first_level_deliverable_must_have_a_title(){
        
        $this->signIn();
        
        $deliverable = Deliverable::factory()->raw(['title'=>'']);
    	
        $this->patch($this->wbs->path(), $deliverable)
            ->assertSessionHasErrors('title', null, 'deliverable');
    
    }
    
    /** @test */
    public function guests_cannot_initiate_wbs()
    {
        
        $deliverable = Deliverable::factory()->raw();
        
        $this->get($this->wbs->project->path().'/wbs/create')
            ->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->post($this->wbs->project->path().'/wbs', $deliverable)
            ->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->assertDatabaseMissing('deliverables', $deliverable);
    }
    
    /** @test */
    public function guests_cannot_add_new_first_level_deliverables()
    {
        
        $deliverable = Deliverable::factory()->raw([
            'wbs_id' => $this->wbs->id
        ]);
        
        $this->get(route('projects.deliverables.index',['project'=>$this->wbs->project]))
            ->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->post(route('projects.deliverables.index', $this->wbs->project), $deliverable)
            ->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->assertDatabaseMissing('deliverables', $deliverable);
            
    }
    
    /** @test */
    public function first_level_deliverable_can_have_custom_order()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $deliverable = Deliverable::factory()->raw([
            'order' => 9,
            'wbs_id' => $this->wbs
        ]);
        
        $this->followingRedirects()
            ->post($this->wbs->project->path().'/deliverables', $deliverable)
            ->assertStatus(200);
        
        $this->assertDatabaseHas('deliverables', $deliverable);
    }
    
    /** @test */
    public function authenticated_users_can_add_new_first_level_deliverables()
    {
        $this->signIn();
        
        $deliverable = Deliverable::factory()->raw([
            'wbs_id' => $this->wbs->id
        ]);
        
        $this->followingRedirects()
            ->post(route('projects.deliverables.index', $this->wbs->project),$deliverable
            )->assertStatus(200);
            
        $this->assertDatabaseHas('deliverables', $deliverable);
            
    }
    
}
