<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Equipment;
use App\Models\ResourceType;
use App\Models\Supplier;

class EquipmentTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $equipment;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->equipment = Equipment::factory()->create();
        $this->resourceType = ResourceType::factory()->create();
    }
    
    /** @test */
    public function equipment_has_resource_type()
    {

        $this->assertDatabaseHas('equipment', $this->equipment->toArray());
        $this->assertInstanceOf(ResourceType::class, $this->equipment->type);
    }
    
    /** @test */
    public function project_has_equipment_as_a_resource()
    {
        $this->withoutExceptionHandling();
        
        $project = Project::factory()->create();
        
        $this->assertDatabaseMissing('resources', [
            'valuable_id' => $this->equipment->id,
            'project_id' => $project->id
        ]);
        
        $this->equipment->assignTo($project, $this->resourceType);
        
        $this->assertDatabaseHas('resources', [
            'valuable_id' => $this->equipment->id,
            'project_id' => $project->id,
            'resource_type_id' => $this->resourceType->id
        ]);

        $this->assertCount(1, $project->resources);

    }
    
    /** @test */
    public function it_has_a_path()
    {
        $this->withoutExceptionHandling();
        $this->assertEquals('/equipment/'.$this->equipment->id, $this->equipment->path());
    }
    
    
    /** @test */
    public function it_have_range_of_products()
    {
        $products = $this->faker->words(5);
        
        $this->equipment->update(['products_range'=> $products]);
        
        $this->assertIsArray($this->equipment->products_range);
        $this->assertCount(5, $this->equipment->products_range);
        
    }
    
    /** @test */
    public function it_have_suppliers()
    {
        $this->withoutExceptionHandling();
        
        $supplyers = Supplier::factory()->count(2)->create();
        
        $this->equipment->suppliers()->attach($supplyers);
        
        $this->equipment->refresh();
        
        tap($this->equipment, function($equipment){
    
            $this->assertCount(2, $equipment->suppliers);
            $this->assertDataBaseHas('supplies', [
                'supplier_id' => $equipment->suppliers()->first()->id,
                'supply_id' => $equipment->id,
                'supply_type' => Equipment::class
            ]);
        });
        
    }
}
