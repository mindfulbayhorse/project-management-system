<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Project;
use \App\WorkBreakdownStructure;
use \App\Status;

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
           
        $this->assertCount(1, $project->wbs()->actual());
        
    }
    
    
    /** @test */
    public function project_has_no_any_status()
    {
    
        $project = factory(Project::class)->create([
                        'title' => 'Cook book',
        ]);
        
        $this->assertEmpty($project->status);
    }
    
    
    /** @test */
    public function project_has_only_one_status()
    {
        
        $status = factory(Status::class)->create([
                        'name' => 'Initiated',
        ]);
        
        $project = factory(Project::class)->create([
                        'title' => 'RSS feeder',
                        'status_id'=>$status->id
        ]);
        
        $this->assertEquals('Initiated', $project->status->name);
    }
}
