<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Equipment;
use App\Models\ResourceType;

class EquipmentTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function project_has_equipment_as_a_resource()
    {
        Project::unsetEventDispatcher();
        $project = Project::factory()->create();
        
        $equipment = Equipment::factory()->create();
        
        $gear = Equipment::factory()->create();
        
        $this->assertDatabaseHas('equipment', $equipment->toArray());
        
        $resourceType = ResourceType::factory()->create(['name'=>'equipment']);
        $resourceType2 = ResourceType::factory()->create(['name'=>'gear']);
        
        $this->assertDatabaseHas('resource_types', $resourceType->toArray());
        
        $resource = $equipment->value($resourceType);
        $resource2 = $gear->value($resourceType2);
        
        $this->assertDatabaseHas('resources', $resource->toArray());
        
        $project->assign($resource);
        $project->assign($resource2);
        
        $this->assertCount(1, $project->resources()->type($equipment));
    }
}
