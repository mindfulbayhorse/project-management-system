<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Deliverable;
use App\Project;
use App\WorkBreakdownStructure;

class DeliverableTest extends TestCase
{
    private $project;
    private $wbs;
    
    protected function setUp():void{
    
        parent::setUp();
        
        $this->project = factory(Project::class)->create();
        $this->wbs = factory(WorkBreakdownStructure::class)->create([
            'project_id' => $this->project->id
        ]);
    }
    
    /** @test */
    public function it_has_a_path()
    {
        $this->withoutExceptionHandling();
        
        $deliverable = factory(Deliverable::class)->create([
            'wbs_id' => $this->wbs->id
        ]);
        
        
        $this->assertEquals(
            $this->project->path().'/deliverables/'.$deliverable->id, 
            $deliverable->path()
        );   
        
        
    }
}
