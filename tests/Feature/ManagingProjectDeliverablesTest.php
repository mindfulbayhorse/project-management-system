<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ManagingProjectDeliverablesTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
	private $project;
	private $wbs;
	private $deliverable;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->project = Project::factory()->create();
		
		$this->wbs = WorkBreakdownStructure::factory()->create(['project_id'=>$this->project->id]);
		
		$this->deliverable = Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);
		
		$this->user = User::factory()->create();
	
	}
	
    
    /** @test */
    public function it_can_be_updated_with_new_title()
    {
        
    	$changedTitle = $this->faker->sentence();
    	
    	$this->actingAs($this->user)
    	    ->patch($this->deliverable->path(),['title' => $changedTitle]
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
        
        $this->actingAs($this->user)
            ->patch($this->deliverable->path(),
                [
                    'package' => true,
                    'title' => $this->deliverable->title
                ]);
        
        $this->assertDatabaseHas('deliverables', [
            'package'=>true,
            'id' => $this->deliverable->id
        ]);
        
    }
    
    /** @test */
    public function it_can_be_marked_as_not_package()
    {
       
        $this->actingAs($this->user)
            ->patch($this->deliverable->path(),[
                'package' => true,
                'title' => $this->deliverable->title
            ]);
        
        $this->patch(
            $this->deliverable->path(),[
                'title' => $this->deliverable->title
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
        
        $this->actingAs($this->user)
            ->patch($this->deliverable->path(),[
                'milestone' => true,
                'title' => $this->deliverable->title
            ]);
        
        $this->assertDatabaseHas('deliverables', [
            'milestone'=>true,
            'id' => $this->deliverable->id
        ]);
        
    }
    
    /** @test */
    public function order_can_be_updated()
    {
        $this->withoutExceptionHandling();
        
        $this->assertEquals(0, $this->deliverable->order);
        
        $this->actingAs($this->user)
            ->patch($this->deliverable->path(),[
            'order' => 1,
            'title' =>$this->deliverable->title
        ]);
            
        $this->assertDatabaseHas('deliverables', [
            'order'=>1
        ]);
        
        $this->deliverable->refresh();
        
        $this->assertEquals(1, $this->deliverable->order);
            
    }
    
    
}
