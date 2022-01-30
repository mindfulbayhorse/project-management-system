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
    public function it_is_a_resource_for_a_project()
    {
        $this->withoutExceptionHandling();
        
        $project = Project::factory()->create();
        
        $this->assertDatabaseMissing('resources', [
            'valuable_id' => $this->equipment->id,
            'project_id' => $project->id
        ]);
        
        $this->equipment->assignTo($project, $this->resourceType->id);
        
        $this->assertDatabaseHas('resources', [
            'valuable_id' => $this->equipment->id,
            'project_id' => $project->id,
            'type_id' => $this->resourceType->id
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
    public function it_has_range_of_products()
    {
        $products = $this->faker->words(5);
        
        $this->equipment->update(['products_range'=> $products]);
        
        $this->assertIsArray($this->equipment->products_range);
        $this->assertCount(5, $this->equipment->products_range);
        
    }
    
    /** @test */
    public function it_has_suppliers()
    {
        $this->withoutExceptionHandling();
        
        $supplyers = Supplier::factory()->count(2)->create();
        
        $equipment = Equipment::factory()
            ->hasAttached($supplyers, ['price' => 150])
            ->create();
        
        $equipment->refresh();
        
        tap($equipment, function($equipment){
    
            $this->assertCount(2, $equipment->suppliers);
            $this->assertDataBaseHas('supplies', [
                'supplier_id' => $equipment->suppliers()->first()->id,
                'supplied_id' => $equipment->id,
                'supplied_type' => Equipment::class
            ]);
        });
        
    }
    
    /** @test */
    public function it_can_be_supplied()
    {
        
        $this->withoutExceptionHandling();
        
         $equipment = Equipment::factory()
            ->hasAttached(Supplier::factory()->count(3)->create(),
                [
                     'price'=>$this->faker->randomNumber(5,false)
                ]
            )
            ->create();
        
        $this->assertCount(3, $equipment->suppliers->toArray());
    }
    
    /** @test */
    public function it_can_be_filtered_by_title()
    {
        Equipment::factory()->count(10)->create();
        
        $name = 'Camera canon R7';
        Equipment::factory()
            ->state([
                'name' => $name
            ])->create();
        
        $result = Equipment::filter(['name' => 'camera canon R7'])->get()->pluck('name');
        
        $this->assertCount(1,  $result->toArray());
        
    }
    
}
