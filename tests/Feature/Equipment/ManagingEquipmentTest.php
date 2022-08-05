<?php

namespace Tests\Feature\Equipment;

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
    public function it_can_be_found_by_title_or_manufacture(){
         
        $model = 'EOS R5';
        $manufacturer = 'Canon';
        
        Equipment::factory()->create([
            'model'=> $model,
            'manufacturer' => $manufacturer
        ]);
        
        $this->signIn();
        $this->actingAs($this->user)
            ->get(route('equipment.index'),['search'=>$manufacturer])
            ->assertSee($model)
            ->assertSee($manufacturer);
        
        $this->actingAs($this->user)
            ->get(route('equipment.index'),['search'=>$model])
            ->assertSee($model)
            ->assertSee($manufacturer);
    }
    
}
