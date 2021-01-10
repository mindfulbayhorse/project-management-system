<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Equipment;
use App\Models\ResourceType;

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
        $this->signIn();
        $this->actingAs($this->user)->get('/equipment')->assertStatus(200);
           
    }   
    
    /** @test */
    public function guests_cannot_manage_an_equipment()
    {
        $this->get('/equipment')->assertRedirect('/login');
        
    }
    
    /** @test */
    public function user_can_choose_type_for_new_equipment()
    {
        $this->withoutExceptionHandling();
        
        $type = ResourceType::factory()->create();
        
        $equipment = Equipment::factory()->raw([
            'resource_type_id' => $type->id
        ]);
        
        $this->signIn();
        
        $this->actingAs($this->user)->followingRedirects()
            ->post('/equipment/', $equipment);
        
        $this->assertEquals($type->name, $equipment->type->name);
        
        $this->assertDatabaseHas('equipment', [
            'name' => $equipment->name,
            'resource_type_id' => $type->id
        ]);
    }
    
    /** @test */
    public function authenticated_user_can_add_an_equipment()
    {
        $equipment = Equipment::factory()->raw();
        
        $this->signIn();
        
        $this->actingAs($this->user)->get('/equipment/create')->assertStatus(200);
        
        $this->actingAs($this->user)->followingRedirects()->post('/equipment/', $equipment)
        ->assertStatus(200)
        ->assertSee($equipment['name']);
        
        $this->assertDatabaseHas('equipment', $equipment);
        
        $equipmentSaved = Equipment::where([
            'name'=> $equipment['name'],
            'model' => $equipment['model']
        ])->first();
        
        $this->actingAs($this->user)->get($equipmentSaved->path())->assertSeeInOrder($equipment);
        
    }
    
}
