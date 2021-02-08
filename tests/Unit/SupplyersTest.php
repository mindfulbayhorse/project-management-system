<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Supplyer;

class SupplyersTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    protected $supplyer;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->supplyer = Supplyer::factory()->create();
    }
    
    /** @test */
    public function id_can_be_ctreated()
    {

        $this->assertDatabaseHas('supplyers', $this->supplyer->toArray());
    }
    
    /** @test */
    public function it_has_a_path()
    {
        $this->withoutExceptionHandling();
        
        $this->assertEquals(route('supplyer', ['supplyer' => $this->supplyer]), $this->supplyer->path());
    }
}
