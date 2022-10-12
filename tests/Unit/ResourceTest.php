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
        
        $equipmentType = ResourceType::factory()->state(['name'=>'Equipment'])->create();
        $subscriptionType = ResourceType::factory()->state(['name'=>'Subscription'])->create();
             
        Equipment::factory()
            ->count(2)
            ->hasAttached(Project::factory()->count(1),[
                    'type_id' => $equipmentType->id
            ],'valuable')
            ->create();

        Subscription::factory()
            ->count(3)
            ->hasAttached(Project::factory()->count(1),[
                    'type_id' => $subscriptionType->id,
                ], 'valuable')
             ->create();
       
        
        $this->assertCount(3,Project::resourceTypes($subscriptionType));
        $this->assertCount(2,Project::resourceTypes($equipmentType));
        
    }
    
    /** @test */
    public function resources_as_equipment_can_be_filtered_by_model() {
        
        $equipmentType = ResourceType::factory()->state(['name'=>'Capital'])->create();
        
        Equipment::factory()
            ->count(5)
            ->hasAttached(Project::factory()->count(1), [
                'type_id' => $equipmentType->id
            ], 'valuable')
            ->create();
        
         $model =  'Canon camera r5';
         $equipment = Equipment::factory()
            ->state(['model' => $model])
            ->count(1)
            ->hasAttached(Project::factory()->count(1), [
                'type_id' => $equipmentType->id
            ], 'valuable')
            ->create();
        
        $result = Resource::filter(Equipment::class, compact('model'))->get();

        $this->assertCount(1, $result->toArray());
        
        $this->assertEquals($equipment[0]->id, $result[0]->valuable_id);
    }
    
}
