<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Deliverable;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Status;
use App\Models\User;

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
    function it_cannot_be_created_by_guest(){
        
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
    function it_can_be_viewed_by_authenticated_user(){
        
        $this->signIn();
        
        $this->get($this->project->path())
            ->assertSee($this->project->title);
        
    }
    
    /** @test */
    function it_cannot_be_viewed_by_guest(){
    	
    	$this->get($this->project->path())->assertRedirect('/login');
    	
    }
    
    /** @test */
    public function its_wbs_cannot_be_initialized_by_guest(){
    	
    	$project = Project::factory()->create();
    	
    	$deliverable = Deliverable::factory()->raw();
    	
    	$this->post($project->path().'/wbs', $deliverable)
    		->assertStatus(302)
    		->assertRedirect('/login');
    	
    	$this->assertDatabaseMissing('deliverables', $deliverable);
    	
    }
    
    /** @test */
    public function it_can_be_edited_my_manager(){
    	
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
    public function it_can_have_a_status()
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
    public function its_card_contains_link_to_active_wbs()
    {
        
        $this->signIn();
        
        $newProject = Project::factory()->create();
        
        $this->get('/projects')
            ->assertDontSee($newProject->wbs()->actual()[0]->path());
        
        Deliverable::factory()->create([
            'wbs_id' => $newProject->wbs()->actual()[0]->id
        ]);
        
        Project::latest('updated_at')
            ->with(['wbs' => function ($query) {
                $query->where('actual', '=', '1');
            }])->get();
        
        $this->get('/projects')
            ->assertSee($newProject->wbs()->actual()[0]->path());
        
    }
    
    /** @test */
    public function its_card_contains_link_to_team()
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
    public function it_is_accessed_by_its_slug()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $this->get('/projects/'.$this->project->slug)
            ->assertStatus(200)
            ->assertSee('<h1>'.$this->project->title.'</h1>', false);
    }
    
    
    /** @test */
    public function it_showes_a_status_in_listing(){
        
        $projectTest = Project::factory(['title'=>'Test project'])
            ->for(Status::factory()->state(['name'=>'test status']))
            ->create();
           
        $this->signIn();
        
        $response = $this->get(route('projects.index'));
        
        $response->assertSee('<h2><a href="'.route('projects.show',$projectTest, false).'">'
            .$projectTest->title.'</a></h2>',false);
        $response->assertSee('<p>'.$projectTest->status->name.'</p>',false);
    }
}
?>