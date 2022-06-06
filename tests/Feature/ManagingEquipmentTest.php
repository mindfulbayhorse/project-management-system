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
    public function authenticated_user_can_add_an_equipment()
    {
        $this->withoutExceptionHandling();
        
        $equipment = Equipment::factory()->raw();
        
        $this->signIn();
        
        $this->actingAs($this->user)->get('/equipment/create')->assertStatus(200);
        
        $this->actingAs($this->user)->followingRedirects()->post('/equipment/', $equipment)
            ->assertStatus(200)
            ->assertSee($equipment['model']);
        
        $this->assertDatabaseHas('equipment', $equipment);
        
        $equipmentSaved = Equipment::where([
            'manufacturer'=> $equipment['manufacturer'],
            'model' => $equipment['model']
        ])->first();
        
        $this->actingAs($this->user)
            ->get($equipmentSaved->path())
            ->assertSee($equipmentSaved->model)
            ->assertSee($equipmentSaved->manufacturer);
        
    }
    
    
    public function it_can_be_found_by_title_or_manufacture(){
        
        
        $model = 'EOS R5';
        $manufacturer = 'Canon';
        
        $equipment = Equipment::factory()->create([
            'model'=> $model,
            'manufacturer' => $brand
        ]);
        
        $this->signIn();
        $this->actingAs($this->user)
            ->get(route('equipment.index'),['search'=>$brand])
            ->assertSee($model)
            ->assertSee($manufacturer);
        
        $this->actingAs($this->user)
            ->get(route('equipment.index'),['search'=>$model])
            ->assertSee($model)
            ->assertSee($manufacturer);
    }
    
}
