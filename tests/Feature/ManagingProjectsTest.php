<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Status;

class ManagingProjectsTest extends TestCase{
    
    use WithFaker, Refreshdatabase;
    
    public $user;
    
    /** @test  */
    function it_can_be_created_by_authenticated_user(){
        
        $this->signIn();
        
        $attributes = Project::factory()->raw(['user_id' => $this->user]);
        
        $response = $this->post('/projects', $attributes);
        
        $response->assertRedirect(Project::where($attributes)->first()->path().'/edit');
        
        $this->assertDatabaseHas('projects', $attributes);
        
        $this->get('/projects')->assertSee($attributes['title']);
    }
    
    /** @test  */
    function guests_cannot_create_projects(){
        
    	$attributes = Project::factory()->raw();
        
    	$this->post('/projects', $attributes)->assertRedirect('/login');   
    	$this->get('/projects/create')->assertRedirect('/login');    
    }
    
    /** @test */
    function it_has_title_required(){
        
    	$this->signIn();
    	
    	$attributes = Project::factory()->raw([
    	    'user_id'=>$this->user,
    	    'title' =>''
    	]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
        
    }
    
    /** @test */
    function a_user_can_view_a_project(){
        
    	$this->signIn();
        
    	$project = Project::factory()->create();
        
        $this->get($project->path())->assertSee($project->title);
        
    }
    
    /** @test */
    function guests_cannot_view_a_project(){
    	
    	$project = Project::factory()->create();
    	
    	$this->get($project->path())->assertRedirect('/login');
    	
    }
    
    /** @test */
    public function guests_cannot_initialize_project_wbs(){
    	
    	$project = Project::factory()->create();
    	
    	$deliverable = Deliverable::factory()->raw();
    	
    	$this->call('POST', $project->path().'/wbs', $deliverable)
    		->assertStatus(302)
    		->assertRedirect('/login');
    	
    	$this->assertDatabaseMissing('deliverables', $deliverable);
    	
    }
    
    /** @test */
    public function only_manager_can_edit_the_project(){
    	
    	$project = Project::factory()->create();
    	$projectChanges = Project::factory()->raw([
    	    'user_id'=>$project->manager
    	]);
    	
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
        
        $this->signIn();
        
        $project = Project::factory()->create([
                'user_id'=>$this->user
        ]);
        $status = Status::factory()->create();
        
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
    
    /** @test */
    public function project_card_contains_link_to_active_wbs()
    {
        
        $this->withoutExceptionHandling();
        $project = Project::factory()->create();
        
        $this->actingAs($project->manager)
        ->get('/projects')
        ->assertDontSeeText('WBS');
        
        Deliverable::factory()->create([
            'wbs_id' => $project->wbs()->actual()[0]->id
        ]);
        
        $this->actingAs($project->manager)
            ->get('/projects')
            ->assertSee($project->wbs()->actual()[0]->path())
            ->assertSeeText('WBS');
        
    }
}
?>