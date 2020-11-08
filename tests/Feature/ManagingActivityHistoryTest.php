<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\WorkBreakdownStructure;
use App\Models\Project;
use App\Models\Deliverable;

class ManagingActivityHistoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $project;
    public $user;
    public $wbs;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->signIn();
        
        $this->project = Project::factory()->create(['user_id' => $this->user]);
        
        $this->wbs = WorkBreakdownStructure::factory()->create(['project_id'=>$this->project->id]);
    }
    
    /** @test */
    public function wbs_has_deliverable_created_history()
    {
        
        Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);
        
        $this->actingAs($this->user)
            ->get($this->wbs->path())
            ->assertSee('deliverable is created');
    }
}
