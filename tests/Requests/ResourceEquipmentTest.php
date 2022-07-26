<?php

namespace Tests\Feature\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\RequestFactories\ResourceEquipmentRequestFactory;
use App\Models\ResourceType;
use App\Models\Project;

class ResourceEquipmentTest extends TestCase
{
    /** @test */
    public function it_can_be_added_to_project()
    {
        $type = ResourceType::factory()->create();
        $project = Project::factory()->create();
        
        ResourceEquipmentRequestFactory::new()->state([
            'type_id' => $type->id, 
            'project_id' => $project->id
        ])->fake();
        
        $this->post(route('projects.equipment.index',['project'=>$project]))
            ->assertValid()
            ->assertStatus(200);
        
        $this->assertDatabaseHas('resources', [
            'type_id'=>$type->id,
            'project_id'=>$project->id]);
    }
}
