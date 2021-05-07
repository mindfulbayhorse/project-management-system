<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ResourceType;
use App\Models\Resource;
use App\Models\Project;
use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Subscription;

class ResourceTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void{
        
        parent::setUp();
        
        $this->project = Project::factory()->create();
    }
    
    /** @test  */
    public function resources_can_be_groupped_by_resource_type()
    {
        $this->withoutExceptionHandling();
        
        $equipmentType = ResourceType::factory()->create(['name'=>'Equipment']);
        $subscriptionType = ResourceType::factory()->create(['name'=>'Subscription']);
             
        Equipment::factory()
            ->count(5)
            ->has(Resource::factory()->
                state([
                    'resource_type_id' => $equipmentType->id,
                    'project_id' => $this->project->id
                ]), 
            'resourceful')
            ->create();
        
        Subscription::factory()
            ->count(3)
            ->has(Resource::factory()->
                state([
                    'resource_type_id' => $subscriptionType->id,
                    'project_id' => $this->project->id
                ]),
                'resourceful')
             ->create();
        
        $this->assertCount(2,$this->project->resourceTypes());
        
    }
}
