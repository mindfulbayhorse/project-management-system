<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use \App\Project;
use \App\Status;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    /** @test*/
    public function it_has_a_path()
    {
        $project = factory(Project::class)->create();
        $this->assertEquals('/projects/'.$project->id, $project->path());
    }
        
    /** @test */
    public function project_has_a_title()
    {
        $project = factory(Project::class)->create(['title' => 'Beadshine']);
        $this->assertEquals('Beadshine', $project->title);
    }
       
    /** @test */
    public function it_has_no_any_status()
    {
        $project = factory(Project::class)->create();
        $this->assertEmpty($project->status);
    }
    
    /** @test */
    public function it_has_only_one_status()
    {
        $project = factory(Project::class)->create();
        $status = factory(Status::class)->create(['name' => 'Initiated']);
        
        $project->status_id = $status->id;
        $project->save();
        
        $this->assertEquals('Initiated', $project->status->name);
    }
}
