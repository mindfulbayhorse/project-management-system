<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Equipment;
use App\Models\Supplier;

class EquipmentTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $equipment;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->equipment = Equipment::factory()->create();
        
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
    public function it_can_be_found_by_title()
    {
        Equipment::factory()->count(10)->create();
        
        $model = 'Camera canon R7';
        Equipment::factory()
            ->state([
                'model' => $model
            ])->create();
        
        $result = Equipment::filter(['search' => 'camera canon R7'])->get()->pluck('model');
        
        $this->assertCount(1,  $result->toArray());
        
    }
    
}
