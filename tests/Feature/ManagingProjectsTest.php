<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Project;
use \App\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;

class ManagingProjectsTest extends TestCase{
    
    use WithFaker, Refreshdatabase;
    
    public $user;
    
    /** @test  */
    function it_can_be_created_by_authenticated_user(){
        
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $attributes = array(
        	"title" => $this->faker->sentence
        );
        
        $response = $this->post('/projects', $attributes);
        
        $response->assertRedirect(Project::where($attributes)->first()->path().'/edit');
        
        $this->assertDatabaseHas('projects', $attributes);
        
        $this->get('/projects')->assertSee($attributes['title']);
    }
    
    /** @test  */
    function guests_cannot_manage_projects(){
        
        $project = factory(Project::class)->create();
        
        $this->post('/projects', $project->toArray())->assertRedirect('/login');
        
        $this->get('/projects')->assertRedirect('/login');
        $this->get('/projects/create')->assertRedirect('/login');

        $this->get($project->path())->assertRedirect('/login');
    }
    
    /** @test */
    function it_has_title_required(){
        
        $attributes = factory(Project::class)->raw(['title' => '']);
        
        $this->actingAs(factory('App\User')->create());
        
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
        
    }
    
    /** @test */
    function a_user_can_view_a_project(){
        
        $this->be(factory('App\User')->create());
        
        $project = factory(Project::class)->create();
        
        $this->get($project->path())->assertSee($project->title);
        
    }
    
    /** @test */
    public function only_authorized_user_can_initialize_project_wbs(){
    	
    	$project = factory(Project::class)->create();
    	
    	$deliverable = factory(Deliverable::class)->raw([
    		'title' => ''
    	]);
    	
    	$this->call('POST', $project->path().'/wbs', $deliverable)
    		->assertStatus(403);
    	
    	$this->assertDatabaseMissing('wbs', [
    		'project_id' => $project->id
    	]);
    	
    }
}
?>