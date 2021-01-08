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
        $this->signIn();
        $this->actingAs($this->user)->get('/equipment')->assertStatus(200);
           
    }   
    
    /** @test */
    public function guests_cannot_manage_an_equipment()
    {
        $this->get('/equipment')->assertRedirect('/login');
        
    }
    
    /** @test */
    public function user_must_choose_type_for_new_equipment()
    {
        $this->withoutExceptionHandling();
        
        $equipment = Equipment::factory()->raw();
        
        $this->signIn();
        
        $response= $this->actingAs($this->user)->followingRedirects()
            ->post('/equipment/', $equipment);
        
            //$response->assertJsonValidationErrors(['type_id']);
            $response->assertSessionHasErrors(['type_id']);
        
        $this->assertDatabaseMissing('equipment', $equipment);
        //dd($response);
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
