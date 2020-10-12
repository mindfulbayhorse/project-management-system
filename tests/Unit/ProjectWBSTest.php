<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Project;
use \App\WorkBreakdownStructure;
use \App\Deliverable;

class ProjectWBSTest extends TestCase
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
        
        $newWbs = factory(WorkBreakdownStructure::class)->make();
        
        $this->project->initializeWBS($newWbs);
        $this->project->actualizeWBS($newWbs);
        
        $this->firstWBS = $this->project->wbs()->actual()->first();
        
    }
    
    /** @test */
    public function its_deliverables_are_ordered()
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
        
        $actualWBS = WorkBreakdownStructure::find($this->firstWBS->id);
        
        $actualWBS->add($deliverable);
        
        $actualWBS->add($deliverable2);
        
        $actualWBS->add($deliverable3);
        
        $deliverables = $actualWBS->deliverables->toArray();
        
        $this->assertEquals(0, key($deliverables));
        $this->assertEquals(0, current($deliverables)['order']);
        
        next($deliverables);
        
        $this->assertEquals(1, key($deliverables));
        
        $this->assertEquals(1, current($deliverables)['order']);
        
        next($deliverables);
        
        $this->assertEquals(2, key($deliverables));
        
        $this->assertEquals(2, current($deliverables)['order']);
    }
    
    /** @test */
    public function it_has_a_path()
    {
        $this->firstWBS->path();
        $this->assertEquals(
            '/projects/'.$this->firstWBS->project_id.'/wbs/'
            .$this->firstWBS->id,
            $this->firstWBS->path());
    }
           
    /** @test */
    public function it_is_deleted_after_deleting_a_project()
    {
        $projectId = $this->project->id;
        $this->assertDatabaseHas('wbs', [
                        'project_id' => $this->project->id
        ]);
        
        $this->project->delete();
        $this->assertDatabaseMissing('wbs', [
                        'project_id' => $projectId
        ]);
        
    }
    
    /** @test */
    public function its_deliverable_can_be_deleted()
    {
    	$deliverables = factory(Deliverable::class, 2)->make();
    	
    	$deliverable1 = $this->firstWBS->add($deliverables->first());
    	
    	$this->firstWBS->add($deliverables->last());
    	
    	$this->assertCount(2, $this->firstWBS->deliverables);
    	
    	$this->delete($deliverables->last());
    	
    	$this->assertEquals($deliverable1->id, $this->firstWBS->deliverables->first()->id);
    }
}
