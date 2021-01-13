<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Equipment;
use App\Models\ResourceType;
use App\Models\ProjectResource;

class ManagingProjectResourcesTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function authenticated_user_can_assign_an_equipment_to_a_project()
    {
        $this->withoutExceptionHandling();
        
        $project = Project::factory()->create();
        
        $equipment = Equipment::factory()->create();
        
        $this->actingAs($project->manager)
            ->get($project->path().'/resources/equipment/assign')
            ->assertStatus(200);
            
        $this->actingAs($project->manager)
            ->followingRedirects()
            ->post($project->path().'/resources/equipment/',[
                    'equipment_id' => $equipment->id
            ])->assertStatus(200);
        
        $this->assertCount(1, $project->resources);
    }
}
