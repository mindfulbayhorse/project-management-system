<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\User;

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
		    
		$this->user = User::factory()->create();
		
		$role = Role::factory()
		    ->hasPermissions(1, ['name' => 'manage_project'])
		    ->create();
		
		$this->user->assignRole($role);
		$this->user->refresh();
	
	}
    
	/** @test  */
	function it_cannot_be_modified_by_users_without_manager_permissions()
	{

	    $user = User::factory()->create();
	    
	    $titleNew = $this->faker->sentence;
	    
	    $this->actingAs($user)
	        ->patch($this->deliverable->path(),[
	            'title' => $titleNew,
	            'wbs_id' => $this->deliverable->wbs->id
	        ])
	        ->assertStatus(403);

        $this->assertDatabaseMissing('deliverables', [
            'title' => $titleNew,
            'id' => $this->deliverable->id
        ]);
	    
	}
	
    /** @test */
    public function it_can_be_updated()
    {
        
        $this->signIn($this->user);

    	$changedTitle = $this->faker->sentence();
    	
    	$this->patch($this->deliverable->path(),[
    	        'title' => $changedTitle,
    	        'wbs_id' => $this->deliverable->wbs_id
    	    ]
    	);
    	
    	$this->deliverable->refresh();
    	
    	$this->assertDatabaseHas('deliverables', [
    	    'title' => $changedTitle,
    	    'id' => $this->deliverable->id
    	]);
    	
    }
    
    /** @test */
    public function it_can_be_marked_as_package()
    {
        $this->withoutExceptionHandling();
        $this->signIn($this->user);
        
        $this->post(route('create_package',[
                'deliverable' => $this->deliverable
            ]));
        
        $this->assertDatabaseHas('deliverables', [
            'package'=>1,
            'id' => $this->deliverable->id,
            'wbs_id' => $this->deliverable->wbs_id
        ]);
        
    }
    
    /** @test */
    public function it_can_be_marked_as_not_package()
    {
        $this->signIn($this->user);
        
        $this->delete(route('destroy_package',[
                'deliverable' => $this->deliverable
            ]));
        
        $this->assertDatabaseHas('deliverables', [
            'package' => false,
            'id' => $this->deliverable->id
        ]);
        
    }
    
    /** @test  */
    function it_cannot_be_modified_by_guests()
    {
        
        $titleNew = $this->faker->sentence;

        $this->patch($this->deliverable->path(),['title' => $titleNew])
            ->assertStatus(302)
            ->assertRedirect('/login');
            
    }
    
    /** @test */
    public function it_cannot_be_created_by_guests()
    {
        
        $deliverable = Deliverable::factory()->raw();
        
        $this->get(route('projects.deliverables.index',$this->deliverable->wbs->project))
            ->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->post(route('projects.deliverables.index',  $this->deliverable->wbs->project), 
                $deliverable)
            ->assertStatus(302)
            ->assertRedirect('/login');
        
        $this->assertDatabaseMissing('deliverables', $deliverable);
        
    }
    
    /** @test */
    public function it_can_be_marked_as_milestone()
    {
        $this->signIn($this->user);
        
        $this->post(route('create_milestone',[
                $this->deliverable
            ]));
        
        $this->assertDatabaseHas('deliverables', [
            'milestone'=>true,
            'id' => $this->deliverable->id
        ]);
        
    }
    
    /** @test */
    public function it_can_be_marked_as_not_milestone()
    {
        $this->signIn($this->user);
        
        $this->delete(route('destroy_milestone',[
            'deliverable' => $this->deliverable
        ]));
        
        $this->assertDatabaseHas('deliverables', [
            'milestone'=>false,
            'id' => $this->deliverable->id
        ]);
        
    }

    /** @test */
    public function its_order_can_be_updated_by_project_manager()
    {
        $this->signIn($this->user);
        
        $this->patch($this->deliverable->path(),[
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
    public function it_can_be_created_by_project_manager()
    {
        $this->signIn($this->user);
        
        $deliverable = Deliverable::factory()
            ->for(WorkBreakdownStructure::factory(), 'wbs')
            ->raw();
        
        $this->post(
            route('projects.deliverables.index', $this->deliverable->wbs->project), $deliverable);
        
        $this->assertDatabaseHas('deliverables', $deliverable);
     
    }
     
    /** @test */
    public function it_can_be_broken_down()
    {
        $this->signIn($this->user);
        
        $this->get($this->deliverable->path())
            ->assertStatus(200);
        
        $deliverable = Deliverable::factory()->raw([
            'wbs_id' => $this->deliverable->wbs->id,
            'parent_id' => $this->deliverable->id
        ]);
        
        $this->post(route('projects.deliverables.index', $this->deliverable->wbs->project),
                $deliverable)->assertRedirect($this->deliverable->path());
        
        $this->assertDatabaseHas('deliverables', $deliverable);
    }
    
    /** @test */
    public function its_order_can_be_set_by_project_manager()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn($this->user);
        
        $deliverable = Deliverable::factory()->raw([
            'order' => 9,
            'wbs_id' => $this->deliverable->wbs->id
        ]);
        
        $this->followingRedirects()
            ->post(route('projects.deliverables.index', $this->deliverable->wbs->project), 
                $deliverable)
            ->assertStatus(200);
        
        $this->assertDatabaseHas('deliverables', $deliverable);
    }
    

}
