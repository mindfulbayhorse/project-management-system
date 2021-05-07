<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Resource;
use App\Models\User;
use App\Models\ResourceType;
use App\Models\Project;

class UserResourceTest extends TestCase
{
	
	use WithFaker, RefreshDatabase;
	
	private $resourceType;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->resourceType = ResourceType::factory()->create();
		$this->project = Project::factory()->create();
		$this->signIn();
	}
    
    /** @test */
    public function user_can_be_valued_as_a_resource()
    {
    	$this->withoutExceptionHandling();
    	
    	$this->user->assignTo($this->project, $this->resourceType->id);
    	
    	$this->assertDatabaseHas('resources',[
    		'valuable_id' => $this->user->id,
    		'valuable_type' => get_class($this->user),
    	    'resource_type_id' => $this->resourceType->id,
    	    'project_id' => $this->project->id
    	]);
    	
    	$this->assertTrue($this->user->isResource());
    	
    	$this->assertTrue($this->user->isAssignedTo($this->project));
    }
    
    /** @test */
    public function user_can_be_withdrawn_from_resources()
    {
    	$this->withoutExceptionHandling();
    	$this->user->assignTo($this->project, $this->resourceType->id);
    	
    	$this->user->withdraw($this->project)->delete();
    	
    	$this->assertDatabaseMissing('resources',[
    		'valuable_id' => $this->user->id,
    		'valuable_type' =>get_class($this->user),
    	    'project_id' => $this->project->id
    	]);
    	
    	$this->assertFalse($this->user->isResource());
    	$this->assertFalse($this->user->isAssignedTo($this->project));
    }    
   
}
