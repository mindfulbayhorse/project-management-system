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
    public function new_candidate_must_have_name_and_surname()
    {
        
        $candidate = User::factory()->raw([
            'first_name'=>'',
            'last_name' =>''
        ]);
        
        $this->actingAs($this->project->manager)
            ->post('/candidates', $candidate)
            ->assertSessionHasErrors(['first_name','last_name']);
        
    }
    
    /** @test */
    public function project_manager_can_add_candidate()
    {

        $this->withoutExceptionHandling();
        
        $this->actingAs($this->project->manager)
            ->get('/candidates/create')
            ->assertStatus(200);
        
        $candidate = User::factory()->raw();
        
        $this->actingAs($this->project->manager)->followingRedirects()
            ->post('/candidates', $candidate)
            ->assertStatus(200)
            ->assertSee($candidate['first_name'])
            ->assertSee($candidate['last_name']);

        $this->assertDatabaseHas('users', [
            'first_name' => $candidate['first_name'],
            'last_name' => $candidate['last_name']
        ]);
    }
    
    
    /** @test */
    public function candidate_can_be_edited(){
        
        $this->withoutExceptionHandling();
        
        $candidate = User::factory()->create();
        
        $this->actingAs($this->project->manager)
            ->get($candidate->path())
            ->assertStatus(200);
        
    }
    
   
}
