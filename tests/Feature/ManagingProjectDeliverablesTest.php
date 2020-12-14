<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagingProjectDeliverablesTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
	private $project;
	private $wbs;
	private $deliverable;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->project = Project::factory()->create();
		
		$this->wbs = WorkBreakdownStructure::factory()->create(['project_id'=>$this->project->id]);
		
		$this->deliverable = Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);
	
	}
    
    /** @test */
    public function the_title_of_deliverable_can_be_updated()
    {
        
    	$changedTitle = $this->faker->sentence();
    	
    	$this->actingAs($this->project->manager)
    	    ->patch($this->deliverable->path(),[
    	        'title' => $changedTitle,
    	        'wbs_id' => $this->deliverable->wbs_id
    	    ]
    	);
    	
    	$this->assertDatabaseHas('deliverables', [
    	    'title' => $changedTitle,
    	    'id' => $this->deliverable->id
    	]);
    	
    }
    
    /** @test */
    public function it_can_be_marked_as_package()
    {
        $this->signIn();
        
        $this->actingAs($this->project->manager)
            ->patch($this->deliverable->path(),
                [
                    'package' => true,
                    'title' => $this->deliverable->title,
                    'wbs_id' => $this->deliverable->wbs_id
                ]);
        
        $this->assertDatabaseHas('deliverables', [
            'package'=>true,
            'id' => $this->deliverable->id,
            'wbs_id' => $this->deliverable->wbs_id
        ]);
        
    }
    
    /** @test */
    public function it_can_be_marked_as_not_package()
    {
       
        $this->actingAs($this->project->manager)
            ->patch($this->deliverable->path(),[
                'package' => true,
                'title' => $this->deliverable->title,
                'wbs_id' => $this->deliverable->wbs_id
            ]);
        
        $this->patch(
            $this->deliverable->path(),[
                'title' => $this->deliverable->title,
                'wbs_id' => $this->deliverable->wbs_id
            ]);
        
        $this->assertDatabaseHas('deliverables', [
            'package' => false,
            'id' => $this->deliverable->id
        ]);
        
    }
    
    /** @test  */
    function guests_cannot_update_deliverable()
    {
        
        $titleNew = $this->faker->sentence;
        
        $this->patch($this->deliverable->path(),['title' => $titleNew])
            ->assertStatus(302)
            ->assertRedirect('/login');
         
    }
    
    /** @test */
    public function it_can_be_marked_as_milestone()
    {
        
        $this->actingAs($this->project->manager)
            ->patch($this->deliverable->path(),[
                'milestone' => true,
                'title' => $this->deliverable->title,
                'wbs_id' => $this->deliverable->wbs_id
            ]);
        
        $this->assertDatabaseHas('deliverables', [
            'milestone'=>true,
            'id' => $this->deliverable->id
        ]);
        
    }

    /** @test */
    public function order_can_be_updated()
    {
        
        $this->actingAs($this->project->manager)
            ->patch($this->deliverable->path(),[
            'order' => 1,
            'title' =>$this->deliverable->title,
            'wbs_id' => $this->deliverable->wbs_id
        ]);
            
        $this->assertDatabaseHas('deliverables', [
            'order'=>1
        ]);
        
        $this->deliverable->refresh();
        
        $this->assertEquals(1, $this->deliverable->order);
            
    }
       
    /** @test */
    public function manager_can_add_deliverable()
    {
        $wbs = WorkBreakdownStructure::factory()->create([
            'project_id' => $this->project->id
        ]);
        
        $deliverable = Deliverable::factory()->raw([
            'wbs_id' => $wbs->id
        ]);
        
        $this->actingAs($this->project->manager)->post(
            route('projects.deliverables.index', $this->project), $deliverable);
        
        $this->assertDatabaseHas('deliverables', $deliverable);
     
        $this->assertCount(1, $wbs->deliverables);
    }
     
    /** @test */
    public function manager_can_break_down_deliverable()
    {
        $this->actingAs($this->project->manager)->get($this->deliverable->path())
            ->assertStatus(200);
        
        $deliverable = Deliverable::factory()->raw([
            'wbs_id' => $this->wbs->id,
            'parent_id' => $this->deliverable->id
        ]);
        
        $this->actingAs($this->project->manager)
            ->post(route('projects.deliverables.index', $this->project),
                $deliverable)->assertRedirect($this->deliverable->path());
        
        $this->assertDatabaseHas('deliverables', $deliverable);
    }
}
