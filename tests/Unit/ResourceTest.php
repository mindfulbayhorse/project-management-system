<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Resource;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ResourceTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    protected $project;
    
    protected function setUp(): void
    {
        
        parent::setUp();
        
        //new project is created
        $this->project = Project::factory()->create();
               
    }
    
	/** @test */
	 public function resources_can_be_assigned_to_a_project()
	 {
	 
	     $this->withoutExceptionHandling();
	     
	     $resources = Resource::factory()->create();
	 
	     $this->project->assign($resources);
	 
	     $this->assertCount(1, $this->project->resources);
	 }
	 
	 /** @test */
	 public function one_recource_can_be_assigned_to_project()
	 {
	     $this->withoutExceptionHandling();
	     
	     $resources = Resource::factory()->count(3)->create();
	     
	     $this->project->assign($resources);
	     
	     $this->assertCount(3, $this->project->resources);
	 }
}
