<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use \Tests\TestCase;
use \App\Project;
use \App\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use App\Status;

class ManagingProjectsTest extends TestCase{
    
    use WithFaker, Refreshdatabase;
    
    public $user;
    
    /** @test  */
    function it_can_be_created_by_authenticated_user(){
        
        $this->signIn();
        
        $attributes = ProjectFactory::managedBy($this->user)
        	->newAttributes();
        
        $response = $this->post('/projects', $attributes);
        
        $response->assertRedirect(Project::where($attributes)->first()->path().'/edit');
        
        $this->assertDatabaseHas('projects', $attributes);
        
        $this->get('/projects')->assertSee($attributes['title']);
    }
    
    /** @test  */
    function guests_cannot_create_projects(){
        
    	$attributes = ProjectFactory::newAttributes();
        
    	$this->post('/projects', $attributes)->assertRedirect('/login');   
    	$this->get('/projects/create')->assertRedirect('/login');    
    }
    
    /** @test */
    function it_has_title_required(){
        
    	$this->signIn();
    	
    	$attributes = ProjectFactory::managedBy($this->user)
    		->withTitle('')
    		->newAttributes();

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
        
    }
    
    /** @test */
    function a_user_can_view_a_project(){
        
    	$this->signIn();
        
    	$project = ProjectFactory::create();
        
        $this->get($project->path())->assertSee($project->title);
        
    }
    
    /** @test */
    function guests_cannot_view_a_project(){
    	
    	$project = ProjectFactory::create();
    	
    	$this->get($project->path())->assertRedirect('/login');
    	
    }
    
    /** @test */
    public function guests_cannot_initialize_project_wbs(){
    	
    	$project = ProjectFactory::create();
    	
    	$deliverable = factory(Deliverable::class)->raw();
    	
    	$this->call('POST', $project->path().'/wbs', $deliverable)
    		->assertStatus(403);
    	
    	$this->assertDatabaseMissing('deliverables', $deliverable);
    	
    }
    
    /** @test */
    public function only_manager_can_edit_the_project(){
    	
    	$project = ProjectFactory::create();
    	$projectChanges = ProjectFactory::managedBy($project->manager)
    		->newAttributes();
    	
    	$this->actingAs($project->manager)
    		->patch($project->path(),$projectChanges);
    	
    	$this->assertDatabaseHas('projects', array_merge([
    			'id' => $project->id
    			], $projectChanges
    		));
    }
    
    /** @test */
    public function project_status_can_be_added_to_project()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $project = ProjectFactory::managedBy($this->user)->create();
        $status = factory(Status::class)->create();
        
        $response = $this->patch($project->path(), [
            'title' => $project->title,
            'status_id' => $status->id,
            'user_id' =>$project->manager->id
        ]);
        
        $this->assertDatabaseHas('projects',[
            'id' => $project->id,
            'status_id' =>$status->id
        ]);
    }
}
?>