<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class ManagingProjectDeliverablesTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
	private $deliverable;
	
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->deliverable = Deliverable::factory()
		    ->for(WorkBreakdownStructure::factory(),'wbs')
		    ->create();
	
	}
    
    /** @test */
    public function the_title_of_deliverable_can_be_updated()
    {
        $this->signIn();
        
    	$changedTitle = $this->faker->sentence();
    	
    	$this->patch($this->deliverable->path(),[
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
        
        $this->actingAs($this->user)
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
        $this->signIn();
        
        $this->actingAs($this->user)
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
        $this->signIn();
        
        $this->actingAs($this->user)
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
        $this->signIn();
        
        $this->actingAs($this->user)
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
    public function authenticated_user_can_add_deliverable()
    {
        $this->signIn();
        
        $deliverable = Deliverable::factory()
            ->for(WorkBreakdownStructure::factory(), 'wbs')
            ->raw();
        
        $this->actingAs($this->user)->post(
            route('projects.deliverables.index', $this->deliverable->wbs->project), $deliverable);
        
        $this->assertDatabaseHas('deliverables', $deliverable);
     
    }
     
    /** @test */
    public function deliverable_can_have_a_breakdown()
    {
        $this->signIn();
        
        $this->actingAs($this->user)->get($this->deliverable->path())
            ->assertStatus(200);
        
        $deliverable = Deliverable::factory()->raw([
            'wbs_id' => $this->deliverable->wbs->id,
            'parent_id' => $this->deliverable->id
        ]);
        
        $this->actingAs($this->user)
            ->post(route('projects.deliverables.index', $this->deliverable->wbs->project),
                $deliverable)->assertRedirect($this->deliverable->path());
        
        $this->assertDatabaseHas('deliverables', $deliverable);
    }
    
    
    /** @test */
    public function its_start_date_is_validated_with_project_start_date()
    {
        $this->withoutExceptionHandling();
         
        $this->assertEmpty($this->deliverable->wbs->project->start_date);
        $this->assertEmpty($this->deliverable->start_date);
         
        $startDeliverable = Carbon::create(2021, 1, 21, 12);
        Carbon::setTestNow($startDeliverable);
         
        $this->deliverable->update(['start_date' => $startDeliverable]);
         
        //$this->assertEquals($this->deliverable->start_date, $this->deliverable->wbs->project->start_date);
    }
}
