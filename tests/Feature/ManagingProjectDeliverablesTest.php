<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Project;
use App\WorkBreakdownStructure;
use App\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Facades\Tests\Setup\DeliverableFactory;
use Facades\Tests\Setup\WorkBreakdownStructureFactory;

class ManagingProjectDeliverablesTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
	private $project;
	private $wbs;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->project = ProjectFactory::create();
		
		$this->wbs = WorkBreakdownStructureFactory::withinProject($this->project->id)
		    ->create();
	
	}
	
    
    /** @test */
    public function it_can_be_updated_with_new_title()
    {
        
        $this->signIn();
        
    	$deliverable = DeliverableFactory::withinWBS($this->wbs->id)->create();
    	
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
        
        $deliverable = DeliverableFactory::withinWBS($this->wbs->id)->create();
        
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
        
        $deliverable = DeliverableFactory::withinWBS($this->wbs->id)->create();
        
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
        
        $deliverable = DeliverableFactory::withinWBS($this->wbs->id)->create();
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
        
        $deliverable = DeliverableFactory::withinWBS($this->wbs->id)->create();
        
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
