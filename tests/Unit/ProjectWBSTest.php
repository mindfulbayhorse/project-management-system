<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;

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
        $this->project = Project::factory()->create();
        
        $newWbs = WorkBreakdownStructure::factory()->make();
        
        $this->project->initializeWBS($newWbs);
        $this->project->actualizeWBS($newWbs);
        
        $this->firstWBS = $this->project->wbs()->actual()->first();
        
    }
    
    /** @test */
    public function its_deliverables_are_ordered_by_auto_incresed_order()
    {
        
        Deliverable::factory()->create([
            'wbs_id' => $this->firstWBS->id,
            'order' => ''
        ]);
        
        Deliverable::factory()->create([
            'wbs_id' => $this->firstWBS->id,
            'order' => ''
        ]);
        
        $deliverables =  $this->firstWBS->deliverables->toArray();
        
        $this->assertEquals(0, key($deliverables));
        $this->assertEquals(1, current($deliverables)['order']);
        
        next($deliverables);
        
        $this->assertEquals(1, key($deliverables));
        
        $this->assertEquals(2, current($deliverables)['order']);
        
    }
    
    /** @test */
    public function it_has_a_path()
    {
        $this->firstWBS->path();
        $this->assertEquals(
            $this->firstWBS->project->path().'/wbs/'.$this->firstWBS->id,
            $this->firstWBS->path()
       );
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
        $numberDeliverables = $this->firstWBS->deliverables->count();
    	
    	$deliverable = Deliverable::factory()->raw(['wbs_id'=>'']);
    	
    	$this->firstWBS->add($deliverable);
    	$this->firstWBS->refresh();

    	$newCount = $numberDeliverables+1;
    	
    	$this->assertCount($newCount, $this->firstWBS->deliverables);

    	$this->firstWBS->discard($this->firstWBS->deliverables->last());
    	$this->firstWBS->refresh();
    	
    	$this->assertCount($numberDeliverables, $this->firstWBS->deliverables);
    	
    }
    
    /** test */
    public function wbs_is_initialized_after_project_is_created(){
        
        $project = Project::factory()->create();
        
        $this->assertCount(1, $project->wbs);
        
    }
    
   
}
