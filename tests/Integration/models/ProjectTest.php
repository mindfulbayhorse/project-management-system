<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Project;
use \App\WorkBreakdownStructure;
use \App\Status;
use \App\Deliverable;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    
    private $project;
    private $actualWBS;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        
        parent::setUp();
        
        //new project is created
        $this->project = factory(Project::class)->create([
                        'title' => 'Beadshine',
        ]);
        
        $this->actualWBS = $this->project->wbs()->actual()->first();
        
    }
    
    /** @test */
    public function project_has_a_title()
    {
        $this->assertEquals('Beadshine', $this->project->title);
    }

    /** @test 
    public function wbs_is_created_for_new_project()
    {
        //project has not wbs yet
        /*$this->assertDatabaseMissing('wbs', [
                        'id' => 1,
        ]);
        
        //new wbs is created in project creating event
        $this->assertDatabaseHas('wbs', [
                        'id' => 1,
                        'project_id' => $project->id,
                        'actual' => true
        ]);
        
    }*/
    
    /** @test */
    public function project_has_just_one_actual_wbs()
    {
        $this->assertCount(1, $this->project->wbs()->actual());
        
        //new wbs is created for project       
        $newWbs = factory(WorkBreakdownStructure::class)->create(
                        ['project_id'=>$this->project->id]);
        
        $this->project->actualizeWBS($newWbs);
           
        $this->assertCount(1, $this->project->wbs()->actual());
        
    }
    
    /** @test */
    public function project_has_no_any_status()
    {       
        $this->assertEmpty($this->project->status);
    }
       
    /** @test */
    public function project_has_only_one_status()
    {
        
        $status = factory(Status::class)->create([
                        'name' => 'Initiated',
        ]);
        
        $this->project->status_id = $status->id;
        $this->project->save();
        
        $this->assertEquals('Initiated', $this->project->status->name);
    }
    
    /** @test */
    public function project_wbs_deliverables_are_ordered()
    {
        
        $deliverable = new Deliverable(['title'=>'Prototype']);
        
        $deliverable2 = new Deliverable([
                        'title' => 'Web-based prototypes',
                        'order' => 1
        ]);
        
        $deliverable3 = new Deliverable([
                        'title' => 'Back-end realization',
                        'order' => 2
        ]);
        
        $actualWBS = WorkBreakdownStructure::find($this->actualWBS->id);
        
        $actualWBS->add($deliverable);
        
        $actualWBS->add($deliverable2);
        
        $actualWBS->add($deliverable3);
        
        $deliverables = $actualWBS->deliverables()->ordered()->toArray();
        
        $this->assertEquals(0, key($deliverables));
        $this->assertEquals(0, current($deliverables)['order']);
        
        next($deliverables);
        
        $this->assertEquals(1, key($deliverables));
        
        $this->assertEquals(1, current($deliverables)['order']);
        
        next($deliverables);
        
        $this->assertEquals(2, key($deliverables));
        
        $this->assertEquals(2, current($deliverables)['order']);
    }
    
        
    /** @test 
    public function project_has_been_deleted_with_all_wbs()
    {
        
        
    }*/
}
