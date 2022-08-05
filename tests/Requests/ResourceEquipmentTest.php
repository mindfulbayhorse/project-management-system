<?php

namespace Tests\Feature\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ResourceType;
use App\Models\Project;
use Tests\RequestFactories\EquipmentRequest;
use App\Models\Equipment;

class ResourceEquipmentTest extends TestCase
{
    
    use RefreshDatabase, WithFaker;
    
    /** @test */
    public function authenticated_user_can_add_an_equipment()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $this->actingAs($this->user)->get('/equipment/create')->assertStatus(200);
        $model = $this->faker->word;
        EquipmentRequest::new()->state(['model'=>$model])->fake();
        
        $this->actingAs($this->user)->followingRedirects()
            ->post('/equipment/')
            ->assertValid()
            ->assertStatus(200)
            ->assertSee($model);
        
        $this->assertDatabaseHas('equipment', ['model'=>$model]);
        
        $equipmentSaved = Equipment::where([
            'model' => $model
        ])->first();
        
        $this->actingAs($this->user)
            ->get($equipmentSaved->path())
            ->assertSee($model);
        
    }
    
}
