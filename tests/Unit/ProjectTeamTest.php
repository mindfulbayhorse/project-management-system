<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class ProjectTeamTest extends TestCase
{
    use RefreshDatabase, withFaker;
    
    private $project;
    public $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->signIn();
        $this->project = Project::factory()->create(['user_id' =>$this->user]);
    }
    
    /** @test */
    public function user_can_be_added_to_project_team()
    {
        $this->project->addMember($this->user);
        
        $this->assertCount(1, $this->project->team);
    }
    
    /** @test */
    public function user_cannot_be_added_to_the_same_the_team_twice()
    {
        $this->withoutExceptionHandling();
        $this->project->addMember($this->user);
        
        
        $this->expectException('Exception');
        $this->project->addMember($this->user);
        
        $this->assertCount(1, $this->project->team);
    }
}
