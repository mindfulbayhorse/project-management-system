<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Deliverable;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliverableTest extends TestCase
{
    use RefreshDatabase;
    
    private $project;
    private $wbs;
    private $deliverable;
    
    protected function setUp():void{
    
        parent::setUp();
        
        $this->project = Project::factory()->create();
        
        $this->wbs = WorkBreakdownStructure::find($this->project->fresh()->wbs->first()->id);
        
        $this->deliverable = Deliverable::factory()->create(['wbs_id' => $this->wbs->id]);

    }
    
    /** @test */
    public function it_has_a_path()
    {

        $this->assertEquals(
            $this->project->path().'/deliverables/'.$this->deliverable->id, 
            $this->deliverable->path()
        );   
           
    }
    
    /** @test */
    public function it_can_be_marked_as_a_package()
    {
        
        $this->assertEmpty($this->deliverable->package);
        
        $this->deliverable->makeAsPackage();
        
        $this->assertTrue($this->deliverable->fresh()->package);
        
    }
        
    /** @test */
    public function it_can_be_marked_as_milestone()
    {
        $this->withoutExceptionHandling();
        
        $this->assertEmpty($this->deliverable->milestone);
        
        $this->deliverable->makeAsMilestone();
        
        $this->assertTrue($this->deliverable->fresh()->milestone);
          
    }
    
    /** @test */
    public function it_can_be_marked_as_not_a_package()
    {
        
        $this->assertEmpty($this->deliverable->package);
        
        $this->deliverable->makeAsNotPackage();
        
        $this->assertFalse($this->deliverable->fresh()->package);
        
    }
    
}
