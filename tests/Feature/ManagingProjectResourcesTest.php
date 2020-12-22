<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Equipment;

class ManagingProjectResourcesTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_add_an_equipment_to_project()
    {
        $this->withoutExceptionHandling();
        
        $project = Project::factory()->create();
        
        $equipment = Equipment::factory()->create();
        
        //$resourceType = ResourceType::factory()->create(['name'=>'Equipment']);
        
        //$equipment->value($resourceType);
        
        //$project->addResource($equipment);
        
        $this->actingAs($project->manager)
            ->get($project->path().'/resources/equipment/add')
            ->assertStatus(200);
        
        $this->actingAs($project->manager)
            ->patch($project->path().'/resources/equipment/add',
                ['resource_id'=> $equipment->id])
            ->assertStatus(200);
        
        $this->assertCount(1, $project->resources);
    }
}
