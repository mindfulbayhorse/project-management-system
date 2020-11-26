<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ManagingCandidatesTest extends TestCase
{
    use RefreshDatabase;
    
    public $user;
    protected $project;
    
    protected function setUp():void
    {
        parent::setUp();
        $this->signIn();
        
        $this->project = Project::factory()->create();
    }
    
    
    /** @test */
    public function project_manager_can_see_all_candidates()
    {
        $this->actingAs($this->project->manager)
            ->get('/candidates')
            ->assertStatus(200)
            ->assertSee($this->user->name)
            ->assertSee($this->user->email);
    }
    
    /** @test */
    public function project_manager_can_add_candidate()
    {
        
        $this->actingAs($this->project->manager)
            ->get('/candidates/create')
            ->assertStatus(200);
        
        $candidate = User::factory()->raw();
        
        $this->actingAs($this->project->manager)
            ->post('/candidates', $candidate)
            ->assertRedirect('/candidates');
        
        $this->assertDatabaseHas('users', [
            'name' => $candidate['name'],
            'email' => $candidate['email']
        ]);
    }
}
