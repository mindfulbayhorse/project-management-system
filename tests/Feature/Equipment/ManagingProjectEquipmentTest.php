<?php

namespace Tests\Feature\Equipment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Equipment;
use App\Models\ResourceType;


class ManagingProjectEquipmentTest extends TestCase
{
    use Refreshdatabase;
    
     /** @test */
    public function authenticated_user_can_assign_an_equipment_to_a_project()
    {
        
        $this->signIn();
        
        $equipment = Equipment::factory()->create();
        
        $type = ResourceType::factory()->create();
        
        $this->get($this->project->path().'/equipment/')
            ->assertStatus(200);
            
        $this->actingAs($this->user)
            ->followingRedirects()
            ->post($this->project->path().'/equipment',[
                'equipment_id' => $equipment->id,
                'type_id' => $type->id
                ])
            ->assertStatus(200);
        
        $this->assertCount(1, $this->project->resources);
    }
    
}
