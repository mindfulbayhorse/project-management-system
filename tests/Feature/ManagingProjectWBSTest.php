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
		
		$this->wbs->actualize();
		
	}    
    
    /** @test */
    public function first_level_deliverable_must_have_a_title(){
        
        $deliverable = Deliverable::factory()->raw(['title'=>'']);
    	
        $this->actingAs($this->project->manager)
            ->call('PATCH', $this->wbs->path(), $deliverable)
            ->assertSessionHasErrors('title', null, 'deliverable');
    
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
    
    /** @test */
    public function first_level_deliverable_can_have_custom_order()
    {
        $this->withoutExceptionHandling();
        
        $deliverable = Deliverable::factory()->raw(['order'=>8]);
        
        $this->actingAs($this->project->manager)
            ->followingRedirects()
            ->post($this->wbs->project->path().'/deliverables', $deliverable)
            ->assertSee($deliverable['title']);
            
        //dd($response);
        
        $this->assertDatabaseHas('deliverables', $deliverable);
    }
    
}
