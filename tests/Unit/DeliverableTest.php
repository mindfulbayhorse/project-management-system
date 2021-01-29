<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Deliverable;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;

class DeliverableTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $project;
    private $wbs;
    private $deliverable;
    
    protected function setUp():void{
    
        parent::setUp();
        
        $this->deliverable = Deliverable::factory()->create();

    }
    
    /** @test */
    public function start_and_finish_dates_are_empty_by_default()
    {
        $this->assertNull($this->deliverable->start_date);
        $this->assertNull($this->deliverable->end_date);
    }
    
    /** @test */
    public function it_has_a_path()
    {

        $this->assertEquals(
            $this->deliverable->wbs->project->path().'/deliverables/'.$this->deliverable->id, 
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
    public function it_can_be_marked_as_not_a_package()
    {
        
        $this->assertEmpty($this->deliverable->package);
        
        $this->deliverable->makeAsNotPackage();
        
        $this->assertFalse($this->deliverable->fresh()->package);
        
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
    public function start_dates_can_be_formatted()
    {
        $this->deliverable->start_date  = Carbon::now();

        $this->assertTrue(Carbon::hasFormat($this->deliverable->getStartDate(), 'd/m/Y'));
    }
    
    public function formatted_start_and_finish_dates_can_be_stored()
    {
        
    }
    
}
