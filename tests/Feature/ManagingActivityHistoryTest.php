<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\WorkBreakdownStructure;
use App\Project;
use App\Deliverable;
use Facades\Tests\Setup\ProjectFactory;
use Facades\Tests\Setup\WorkBreakdownStructureFactory;
use Facades\Tests\Setup\DeliverableFactory;

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
        
        $this->project = ProjectFactory::managedBy($this->user)->create();
        
        $this->wbs = WorkBreakdownStructureFactory::withinProject($this->project->id)->create();
    }
    
    /** @test */
    public function wbs_has_deliverable_created_history()
    {
        $this->withoutExceptionHandling();
        
        DeliverableFactory::withinWBS($this->wbs->id)
            ->create();
        
        $this->actingAs($this->user)
            ->get($this->wbs->path())
            ->assertSee('deliverable is created');
    }
}
