<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Deliverable;
use App\Project;
use App\WorkBreakdownStructure;
use Facades\Tests\Setup\ProjectFactory;
use Facades\Tests\Setup\DeliverableFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliverableTest extends TestCase
{
    use RefreshDatabase;
    
    private $project;
    private $wbs;
    private $deliverable;
    
    protected function setUp():void{
    
        parent::setUp();
        
        $this->project = ProjectFactory::create();
        
        $this->wbs = WorkBreakdownStructure::find($this->project->fresh()->wbs->first()->id);
        
        $this->deliverable = DeliverableFactory::withWBS($this->wbs)->create();

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
        
        $this->assertFalse($this->deliverable->package);
        
        $this->deliverable->makeAsPackage();
        
        $this->assertTrue($this->deliverable->fresh()->package);
        
    }
        
    /** @test */
    public function it_can_be_marked_as_milestone()
    {
        $this->withoutExceptionHandling();
        
        $this->assertFalse($this->deliverable->milestone);
        
        $this->deliverable->makeAsMilestone();
        
        $this->assertTrue($this->deliverable->fresh()->milestone);
          
    }
    
      /** @test */
    public function it_can_be_marked_as_not_a_package()
    {
        
        $this->assertFalse($this->deliverable->package);
        
        $this->deliverable->makeAsNotPackage();
        
        $this->assertFalse($this->deliverable->fresh()->package);
        
    }
}
