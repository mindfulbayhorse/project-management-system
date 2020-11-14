<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;

class ManagingProjectTeamTest extends TestCase
{
    use RefreshDatabase;
    
    public $user;
    
    private $project;
    
    protected function setUp():void
    {
        parent::setUp();
        
        $this->signIn();
        
        $this->project = Project::factory()->create(['user_id' => $this->user]);
    }
    
    /** @test */
    public function user_can_be_added_to_the_team()
    {
        
        $user = User::factory()->create();
        
        $this->actingAs($this->project->manager)
            ->post($this->project->path().'/team', ['user_id' => $user->id]);
        
        $this->assertDatabaseHas('project_team', [
            'user_id' => $user->id,
            'project_id' => $this->project->id
        ]);
        
        $this->assertEquals($user->name, $this->project->team[0]->name);
        
    }
    
    /** @test */
    public function user_can_be_chosen_for_a_team()
    {
        
        User::factory()->create();
        
        $this->actingAs($this->project->manager)
            ->get($this->project->path().'/team/edit')
            ->assertStatus(200)
            ->assertSeeInOrder(User::all()->first()->only(['id', 'name']));
        
    }
    
    /** @test */
    public function team_link_is_on_the_project_page()
    {
     
        $this->get($this->project->path().'/edit')
            ->assertSee($this->project->path().'/team')
            ->assertSeeText('Team');
        
    }
    
    /** @test */
    public function manager_can_see_all_members()
    {
        
        $this->project->addMember(User::factory()->create());
        $this->project->refresh();
        
        $this->get($this->project->path().'/team')
            ->assertStatus(200)
            ->assertSeeInOrder($this->project->team->first()->only(['id', 'name','email']));
        
    }
}
