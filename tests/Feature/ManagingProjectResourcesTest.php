<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Equipment;
use App\Models\ResourceType;
use phpDocumentor\Reflection\Types\Void_;
use App\Models\Resource;

class ManagingProjectResourcesTest extends TestCase
{
    use RefreshDatabase;
    
    public $user;
    
    private $project;
    
    protected function setUp(): void 
    {
        parent::setUp();
        
        $this->project = Project::factory()->create();
        
    }
    
    /** @test */
    public function authenticated_user_can_assign_an_equipment_to_a_project()
    {
        
        $this->signIn();
        
        $equipment = Equipment::factory()->create();
        
        $type = ResourceType::factory()->create();
        
        $this->get($this->project->path().'/resources/equipment/assign')
            ->assertStatus(200);
            
        $this->actingAs($this->user)
            ->followingRedirects()
            ->post($this->project->path().'/resources/equipment',[
                'equipment_id' => $equipment->id,
                'type_id' => $type->id
                ])
            ->assertStatus(200);
        
        $this->assertCount(1, $this->project->resources);
    }
    
    
    /** @test */
    public function user_can_see_equipment_section_on_project_resources()
    {
        $this->signIn();
       
        $this->get(route('resources.index', $this->project))
            ->assertSeeText('Equipment')
            ->assertSee('href="'.route('projects.equipment.index', 
                $this->project, false).'"',
               false);
        
    }
    
    
    /** @test */
    public function user_can_see_list_of_equipment_for_project()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $resourceType = ResourceType::factory()->create();
        
        $equipment = Equipment::factory()
        ->count(40)
        ->has(Resource::factory()->state([
            'project_id' => $this->project->id,
            'type_id' => $resourceType->id
        ]),'valuable',)
        ->create();
        
        $this->get(route('projects.equipment.index',$this->project))
            ->assertSeeText($equipment->first()->name)
            ->assertSee(route('equipment.show',$equipment->first()));
        
    }
    
    
    /** @test */
    public function user_can_see_list_of_equipment_for_project_by_type()
    {
         $this->signIn();
         $resourceType = ResourceType::factory()->create();
         
         $equipment = Equipment::factory()
             ->count(40)
             ->has(Resource::factory()->state([
                 'project_id' => $this->project->id,
                 'type_id' => $resourceType->id
                 ]),'valuable',)
             ->create();
        
         $this->get(route('projects.equipment.index',$this->project))
             ->assertSee($equipment->first()->name);
         
    }
}
