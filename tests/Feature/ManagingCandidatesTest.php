<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class ManagingCandidatesTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    protected $project;
    
    protected function setUp():void
    {
        parent::setUp();
        
        $this->project = Project::factory()
            ->for(User::factory(), 'manager')
            ->create();
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
        
        $lastNameNew = $this->faker->lastName;
        
        $this->actingAs($this->project->manager)
            ->followingRedirects()
            ->patch($candidate->path(),[
                'first_name' => $candidate->first_name,
                'email' => $candidate->email,
                'last_name' => $lastNameNew
            ])->assertStatus(200);
            
        tap($candidate, function ($candidate) use  ($lastNameNew){
            
            $this->assertEquals($lastNameNew, $candidate->fresh()->last_name);
            $this->assertDatabaseHas('users', [
                'id' => $candidate->id,
                'last_name' => $lastNameNew
            ]);
        });

    }
   
}
