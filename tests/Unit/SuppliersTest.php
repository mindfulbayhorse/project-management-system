<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Supplier;

class SuppliersTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    protected $supplier;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->supplier = Supplier::factory()->create();
    }
    
    /** @test */
    public function id_can_be_ctreated()
    {

        $this->assertDatabaseHas('suppliers', $this->supplier->toArray());
    }
    
    /** @test */
    public function it_has_a_path()
    {
        $this->withoutExceptionHandling();
        
        $this->assertEquals(route('supplier', ['supplier' => $this->supplier]), $this->supplier->path());
    }
    
    
    /** @test */
    public function it_have_range_of_products()
    {
        $products = $this->faker->words(5);
        
        $this->supplier->update(['products_range'=> $products]);
        
        $this->assertIsArray($this->supplier->products_range);
        $this->assertCount(5, $this->supplier->products_range);
        
    }
}
