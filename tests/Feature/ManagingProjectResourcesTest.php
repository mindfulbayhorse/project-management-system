<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Equipment;
use App\Models\ResourceType;

class ManagingProjectResourcesTest extends TestCase
{
    use RefreshDatabase;
    
    public $user;
    
    /** @test */
    public function authenticated_user_can_assign_an_equipment_to_a_project()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        
        $project = Project::factory()->create();
        
        $equipment = Equipment::factory()->create();
        
        $type = ResourceType::factory()->create();
        
        $this->get($project->path().'/resources/equipment/assign')
            ->assertStatus(200);
            
        $this->actingAs($this->user)
            ->followingRedirects()
            ->post($project->path().'/resources/equipment',[
                'equipment_id' => $equipment->id,
                'type_id' => $type->id
            ])->assertStatus(200);
        
        $this->assertCount(1, $project->resources);
    }
}
