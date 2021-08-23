<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

class SessionProjectInterfaceTest extends TestCase
{
    use RefreshDatabase;
    
    private $project;
    
    public $user;
    
    protected function setUp(): void 
    {
        parent::setUp();
        
        $this->project = Project::factory()->forManager()->create();
        $this->signIn($this->project->manager);
    }
    
    
    /** @test */
    public function save_last_open_project()
    {
        $response = $this->get(route('projects.show',['project'=>$this->project]));
        $response->assertSessionHas('last_project', $this->project->id);
    }
    
    /** @test */
    public function show_last_open_project()
    {
        
        $this->get(route('projects.show',['project'=>$this->project]));
        $response = $this->get(route('projects.index'));
        $response->assertSee('Last watched project: ');
    }
}