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
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->project = Project::factory()->create();
		
		$this->wbs = WorkBreakdownStructure::factory()->create(['project_id'=>$this->project->id]);
	
	}
	
    
    /** @test */
    public function it_can_be_updated_with_new_title()
    {
        
        $this->signIn();
        
    	$deliverable = Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);
    	
    	$changedTitle = $this->faker->sentence();
    	
    	$this->patch(
    		$this->wbs->deliverables[0]->path(),[
    		    'title' => $changedTitle,
    	    ]
    	);
    	
    	$this->assertDatabaseHas('deliverables', [
    	    'title' => $changedTitle,
    	    'id' => $deliverable->id
    	]);
    	
    }
    
    /** @test */
    public function it_can_be_marked_as_package()
    {
        $this->signIn();
        
        $deliverable = Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);
        
        $this->patch(
            $deliverable->path(),[
                'package' => true,
                'title' => $deliverable->title
        ]);
        
        $this->assertDatabaseHas('deliverables', [
            'package'=>true,
            'id' => $deliverable->id
        ]);
        
    }
    
    /** @test */
    public function it_can_be_marked_as_not_package()
    {
        $this->signIn();
        
        $deliverable = Deliverable::factory()->create(['wbs_id' => $this->wbs->id]);
        
        $this->patch(
            $deliverable->path(),[
                'package' => true,
                'title' => $deliverable->title
            ]);
        
        $this->patch(
            $deliverable->path(),[
                'title' => $deliverable->title
            ]);
        
        $this->assertDatabaseHas('deliverables', [
            'package' => false,
            'id' => $deliverable->id
        ]);
        
    }
    
    
    /** @test  */
    function guests_cannot_update_deliverable()
    {
        
        $deliverable = Deliverable::factory()->create(['wbs_id' => $this->wbs->id]);
        $titleNew = $this->faker->sentence;
        
        $response = $this->patch($deliverable->path(),[
            'title' => $titleNew
        ])->assertStatus(403);
         
    }
    
    /** @test */
    public function it_can_be_marked_as_milestone()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $deliverable = Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);
        
        $this->patch(
            $deliverable->path(),[
                'milestone' => true,
                'title' => $deliverable->title
            ]);
        
        $this->assertDatabaseHas('deliverables', [
            'milestone'=>true,
            'id' => $deliverable->id
        ]);
        
    }
    
    
}
