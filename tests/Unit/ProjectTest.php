<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Project;
use App\Models\Status;
use App\Models\WorkBreakdownStructure;
use App\Models\Resource;
use App\Models\User;
use App\Models\ProjectTeam;
use PHPUnit\TextUI\XmlConfiguration\Logging\TeamCity;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    protected $project;
    private $projectWbs;
    private $wbsNew;

    protected function setUp(): void
    {
        
        parent::setUp();
        
        //new project is created
        $this->project = Project::factory()->create();
        $this->project->refresh();
   
    }
    
    /** @test*/
    public function it_has_a_path()
    {
        $this->withoutExceptionHandling();
        
        $this->assertEquals('/projects/'.$this->project->slug, 
                        $this->project->path());
    }
        
    /** @test */
    public function project_has_a_title()
    {
    	$title = $this->faker->word;
    	
    	$this->project->update(['title' => $title]);
    	
    	$this->assertEquals($title, $this->project->title);
    }
       
    /** @test */
    public function it_can_have_no_one_status()
    {
        $this->assertEmpty($this->project->status);
    }
    
    /** @test */
    public function it_has_defined_limit_of_wbs()
    {
    	
    	$this->assertEquals(2, $this->project->wbsLimit);
    }
    
    /** @test */
    public function it_can_have_status_added()
    {
        $status = Status::factory()->create(['name' => 'Initiated']);
        
        $this->project->status_id = $status->id;
        $this->project->save();
        
        $this->assertEquals('Initiated', $this->project->status->name);
    }
    
    /** @test */
    public function it_can_have_initial_wbs()
    {
        
        $this->assertCount(1, $this->project->wbs);
        
    }
    
    /** @test */
    public function it_can_have_only_one_actual_wbs()
    {
        
        $this->assertCount(1, $this->project->wbs()->actual());
        
        $wbsNew = WorkBreakdownStructure::factory()->make();
        
        $this->project->initializeWBS($wbsNew);

        $this->project->actualizeWBS($wbsNew);
        
        $this->project->refresh();
        
        $this->assertCount(1, $this->project->wbs()->actual());
    }
    
    /** @test */
    public function it_can_has_a_limit_for_new_created_wbs()
    {
        $wbsNew = WorkBreakdownStructure::factory()->make();
        
    	$this->assertCount(1, $this->project->wbs);
    	
    	$this->project->initializeWBS($wbsNew);
    	
    	$this->project->refresh();
    	
    	$this->assertCount(2, $this->project->wbs);
    	
    	$wbsThird = WorkBreakdownStructure::factory()->make();
        
        $this->expectException('Exception');
        $this->project->initializeWBS($wbsThird);
        
        $this->project->refresh();
        $this->assertCount(2, $this->project->wbs);
    }
    
    /** @test */
    public function it_can_limit_several_new_created_wbs()
    {
    	
    	$wbs = WorkBreakdownStructure::factory()->count(2)->make();
    	
    	$this->expectException('Exception');
    	$this->project->initializeWBS($wbs);
    	$this->project->refresh();
    	
    	$this->assertCount(2, $this->project->wbs);
    }    
    
    /** @test */
    public function it_has_a_manager()
    {
    	$this->assertEquals($this->project->user_id, $this->project->manager->id);
    }
    
    /** @test */
    public function it_has_unique_slug()
    {
        $project = Project::factory()->create('example');
        
        $this->assertEquals('example-2', $project->createUniqueSlug('example'));
        
    }
    
    /** @test */
    public function it_has_a_team()
    {
        $team = ProjectTeam::factory()->create([
            'project_id'=>$this->project->id
        ]);
        
        $this->assertInstanceOf(User::class, $this->project->team[0]);
        
        $this->assertDatabaseHas('project_team', $team->toArray());
    }
   
}
