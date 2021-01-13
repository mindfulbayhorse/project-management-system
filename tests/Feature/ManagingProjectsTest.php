<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Str;

class ManagingProjectsTest extends TestCase{
    
    use WithFaker, Refreshdatabase;
    
    public $user;
    private $project;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->project = Project::factory()
            ->for(User::factory(), 'manager')
            ->create();
    }
    
    /** @test  */
    function it_can_be_created_by_authenticated_user(){
        
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $attributes = Project::factory()->raw();
        
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
    	    'title' =>''
    	]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
        
    }
    
    /** @test */
    function authenticated_user_can_see_a_project(){
        
        $this->signIn();
        
        $this->get($this->project->path())
            ->assertSee($this->project->title);
        
    }
    
    /** @test */
    function guests_cannot_view_a_project(){
    	
    	$this->get($this->project->path())->assertRedirect('/login');
    	
    }
    
    /** @test */
    public function guests_cannot_initialize_project_wbs(){
    	
    	$project = Project::factory()->create();
    	
    	$deliverable = Deliverable::factory()->raw();
    	
    	$this->post($project->path().'/wbs', $deliverable)
    		->assertStatus(302)
    		->assertRedirect('/login');
    	
    	$this->assertDatabaseMissing('deliverables', $deliverable);
    	
    }
    
    /** @test */
    public function manager_can_edit_the_project(){
    	
    	$projectChanges = ([
    	    'manager_id'=>$this->project->manager->id,
    	    'title' =>$this->faker->sentence
    	]);
    	
    	$this->actingAs($this->project->manager)
    		->patch($this->project->path(), $projectChanges);
    	
    	$this->assertDatabaseHas('projects', [
    		'id' => $this->project->id,
    	    'manager_id'=>$projectChanges['manager_id'],
    	    'title' =>$projectChanges['title']
    	]);
    }
    
    /** @test */
    public function project_status_can_be_added_to_project()
    {
        
        $this->signIn();
        
        $status = Status::factory()->create();
        
        $this->patch($this->project->path(), [
            'title' => $this->project->title,
            'status_id' => $status->id
        ]);
        
        $this->assertDatabaseHas('projects',[
            'id' => $this->project->id,
            'status_id' =>$status->id
        ]);
    }
    
    /** @test */
    public function project_card_contains_link_to_active_wbs()
    {
        
        $this->signIn();
        
        $this->get('/projects')
            ->assertDontSeeText('WBS');
        
        Deliverable::factory()->create([
            'wbs_id' => $this->project->wbs()->actual()[0]->id
        ]);
        
        $this->get('/projects')
            ->assertSee($this->project->wbs()->actual()[0]->path())
            ->assertSeeText('WBS');
        
    }
    
    /** @test */
    public function project_card_contains_link_to_team()
    {
        $this->signIn();
        
        $this->get('/projects')
            ->assertDontSee('Team');
        
        $member = User::factory()->create();
        $this->project->addMember($member);
        
        $this->get('/projects')
            ->assertSee($this->project->path().'/team')
            ->assertSee('Team');
        
    }
       
    /** @test */
    public function project_is_accessed_by_its_slug()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $this->get('/projects/'.$this->project->slug)
            ->assertStatus(200)
            ->assertSee('<h1>'.$this->project->title.'</h1>', false);
    }
}
?>