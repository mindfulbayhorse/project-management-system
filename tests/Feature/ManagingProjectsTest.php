<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Project;
use Illuminate\Foundation\Testing\WithFaker;

class ManagingProjectsTest extends TestCase{
    
    use WithFaker, Refreshdatabase;
    
    /** @test  */
    function it_can_be_created_by_authenticated_user(){
        
        $this->withoutExceptionHandling();
        
        $attributes = factory(Project::class)->raw();
        
        $this->actingAs(factory('App\User')->create());
        
        $this->post('/projects', $attributes)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }
    
    /** @test  */
    function it_cannot_be_created_by_authenticated_user(){
        
        $attributes = factory(Project::class)->raw();
        
        $this->post('/projects', $attributes)->assertRedirect('/login');

    }
    
    /** @test */
    function it_has_title_required(){
        
        $attributes = factory(Project::class)->raw(['title' => '']);
        $this->actingAs(factory('App\User')->create());
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
        
    }
    
    /** @test */
    function a_user_can_view_a_project(){
        
        $this->actingAs(factory('App\User')->create());
        $project = factory(Project::class)->create();
        $this->get($project->path())->assertSee($project->title);
        
    }
}
?>