<?php

namespace Tests\Unit\Equipment;

use Tests\TestCase;
use App\Models\Project;
use App\Models\ResourceType;
use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class ResourceEquipmentTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function project_can_have_resource_as_an_equipment()
    {
        $this->withoutExceptionHandling();
        
        $resourceType = ResourceType::factory()->create();
  
        $equipment = Equipment::factory()->create();
        
        $project = Project::factory()->create();    
        
        $this->assertCount(0, $project->equipment);

        $this->assertDatabaseMissing('resources', [
            'valuable_id' => $equipment->id,
            'project_id' => $project->id
        ]);
        
        $equipment->assignTo($project, $resourceType->id);

        $this->assertDatabaseHas('resources', [
            'valuable_id' => $equipment->id,
            'project_id' => $project->id,
            'type_id' => $resourceType->id,
            'valuable_type' => Equipment::class,
        ]);
        
        $this->assertCount(1, $equipment->valuable);
        $project->refresh();
        $this->assertCount(1, $project->equipment);
        
    }
}
