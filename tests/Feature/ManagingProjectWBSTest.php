<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;
use App\Models\User;
use App\Models\Role;

class ManagingProjectWBSTest extends TestCase
{
	use Refreshdatabase, WithFaker;
	
	private $project;
	private $wbs;
	public $user;
	
	protected function setUp(): void{
		
		parent::setUp();
		
		$this->wbs = WorkBreakdownStructure::factory()
		    ->hasDeliverables(1)
		    ->for(Project::factory(), 'project')
		    ->create();
		
		$this->wbs->actualize();
		
		$this->signIn();
		
	}    
    
    /** @test */
	public function first_deliverable_while_creating_wbs_must_have_a_title(){

        $deliverable = Deliverable::factory()->raw(['title'=>'']);
    	
        $this->actingAs($this->user)
            ->patch($this->wbs->path(), $deliverable)
            ->assertSessionHasErrors('title', null, 'deliverable');
    
    }
    
}
