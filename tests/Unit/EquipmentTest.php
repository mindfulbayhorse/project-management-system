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
    
    private $equipment;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->equipment = Equipment::factory()->create();
    }
    
    /** @test */
    public function equipment_has_resource_type()
    {
        $resourceType = ResourceType::factory()->create(['name'=>'camera']);
        $camera = Equipment::factory()->create(['resource_type_id' => $resourceType->id]);
        
        $this->assertDatabaseHas('equipment', [
            'name' => $camera->name,
            'resource_type_id' => $resourceType->id
        ]);
    }
    
    /** @test */
    public function project_has_equipment_as_a_resource()
    {
        $this->withoutExceptionHandling();
        
        $project = Project::factory()->create();
        
        $resourceType = ResourceType::factory()->create(['name'=>'equipment']);
        
        $this->assertDatabaseHas('equipment', $this->equipment->toArray());
        
        $this->assertDatabaseHas('resource_types', $resourceType->toArray());
        
        $resource = $this->equipment->value();
        
        $this->assertDatabaseHas('resources', $resource->toArray());
        
        $project->assign($resource);

        $this->assertCount(1, $project->resources);

    }
    
    /** @test */
    public function it_has_a_path()
    {
        $this->withoutExceptionHandling();
        $this->assertEquals('/equipment/'.$this->equipment->id, $this->equipment->path());
    }
}
