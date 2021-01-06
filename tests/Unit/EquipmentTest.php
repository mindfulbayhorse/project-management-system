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
    public function project_has_equipment_as_a_resource()
    {
      
        $project = Project::factory()->create();
        
        $gear = Equipment::factory()->create();
        
        $this->assertDatabaseHas('equipment', $this->equipment->toArray());
        
        $resourceType = ResourceType::factory()->create(['name'=>'equipment']);
        $resourceType2 = ResourceType::factory()->create(['name'=>'gear']);
        
        $this->assertDatabaseHas('resource_types', $resourceType->toArray());
        
        $resource = $this->equipment->value($resourceType);

        $resource2 = $gear->value($resourceType2);
        
        $this->assertDatabaseHas('resources', $resource->toArray());
        
        $project->assign($resource);
        $project->assign($resource2);
        
        $this->assertCount(1, $project->resources()->type($this->equipment));
    }
    
    /** @test */
    public function it_has_a_path()
    {
        $this->withoutExceptionHandling();
        $this->assertEquals('/equipment/'.$this->equipment->id, $this->equipment->path());
    }
}
