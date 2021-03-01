<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Deliverable;
use App\Models\Role;
use App\Models\User;

class ProjectWBSTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
    private $project;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->signIn();
		
		$this->project = Project::factory()->create();
		
		$this->project->refresh();
		
		$role = Role::factory()
    		->hasPermissions(1, ['name' => 'manage_project'])
    		->create();
		
		$this->user = User::factory()
		    ->hasAttached($role)
    		->create();
		
	}
    
	/** @test */
    public function new_project_has_actual_wbs_by_default()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn($this->user);
        
        $this->assertCount(1, $this->project->wbs()->actual());
    	
        $deliverable = Deliverable::factory()->raw([
            'wbs_id' => $this->project->wbs()->actual()->first()->id
        ]);

        $this->followingRedirects()
            ->post($this->project->path().'/deliverables', $deliverable)
            ->assertStatus(200);
        
        $this->project->wbs()->actual()->first()->refresh();
        $this->assertCount(1, $this->project->wbs()->actual());

        $this->assertCount(1, $this->project->wbs()->actual()->first()->deliverables);

    }
}
