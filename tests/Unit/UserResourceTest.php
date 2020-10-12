<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use \App\Resource;
use \App\User;
use \App\ResourceType;

class UserResourceTest extends TestCase
{
	
	use WithFaker, RefreshDatabase;
	
	private $resourceType;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->resourceType = factory(ResourceType::class)->create();
		$this->signIn();
	}
    
    /** @test */
    public function user_can_be_valued_as_a_resource()
    {
    	$this->withoutExceptionHandling();
    	
    	$this->user->value($this->resourceType);
    	
    	$this->assertDatabaseHas('resources',[
    		'valuable_id' => $this->user->id,
    		'valuable_type' =>get_class($this->user)
    	]);
    	
    	$this->assertTrue($this->user->isResource());
    }
    
    /** @test */
    public function user_can_be_devalued_as_a_resource()
    {
    	$this->withoutExceptionHandling();
    	
    	$this->user->value($this->resourceType);
    	$this->user->devalue($this->resourceType);
    	
    	$this->assertDatabaseMissing('resources',[
    		'valuable_id' => $this->user->id,
    		'valuable_type' =>get_class($this->user)
    	]);
    	
    	$this->assertFalse($this->user->isResource());
    }
    
    /** @test */
    public function user_resourcfulness_can_be_toggled()
    {
    	$this->withoutExceptionHandling();
    	
    	$this->user->toggleCredit($this->resourceType);
    	
    	$this->assertTrue($this->user->isResource());
    	
    	$this->user->toggleCredit($this->resourceType);
    	
    	$this->assertFalse($this->user->isResource());
    }
    
   
}
