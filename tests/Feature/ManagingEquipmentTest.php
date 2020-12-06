<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Equipment;

class ManagingEquipmentTest extends TestCase
{
    use RefreshDatabase, withFaker;
    
    public $user;
    
    protected function setUp(): void{
        
        parent::setUp();
        
        
    }
    
    /** @test */
    public function authenticated_user_can_see_equipment()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $this->actingAs($this->user)->get('/equipment')->assertStatus(200);
           
    }
    
    /** @test */
    public function authenticated_user_can_add_an_equipment()
    {
        $equipment = Equipment::factory()->raw();
        $this->signIn();
        $this->actingAs($this->user)->get('/equipment/create')->assertStatus(200);
        $this->actingAs($this->user)->post('/equipment/', $equipment);
        $this->assertDatabaseHas('equipment', $equipment);
        
    }
    
    /** @test */
    public function guests_cannot_manage_an_equipment()
    {
        $this->get('/equipment')->assertRedirect('/login');
        
    }
}
