<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Project;
use \App\WorkBreakdownStructure;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function at_least_one_wbs_is_created_for_project()
    {
        //project has not wbs yet
        $this->assertDatabaseMissing('wbs', [
                        'id' => 1,
        ]);
        
        //new project is created
        $project = factory(Project::class)->create([
                        'title' => 'Beadshine',
        ]);
        
        //new wbs is created in project creating event
        $this->assertDatabaseHas('wbs', [
                        'id' => 1,
                        'project_id' => $project->id,
                        'actual' => true
        ]);
        
    }
    
    /** @test */
    public function project_has_just_one_actual_wbs()
    {
        //new project is created
        $project = factory(Project::class)->create([
                        'title' => "Master's tresure",
        ]);
        
        $newWBS = factory(WorkBreakdownStructure::class)->create(['project_id'=>$project->id]);
        
        foreach($project->wbs()->actual() as $wbs){
            $wbs->archive();         
        }
        
        $newWBS->actualize();
           
        $this->assertEquals(1, $project->wbs()->actual()->count());
        
    }
    
    
    /** @test */
    /*public function wbs_deliverables_list_is_ordered()
    {
        
    }*/
}
