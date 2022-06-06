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
            ->has(Resource::factory()
            ->state([
                    'type_id' => $equipmentType->id,
                    'project_id' => $this->project->id
                ]), 'valuable')
            ->create();
        
        Subscription::factory()
            ->count(3)
            ->has(Resource::factory()
            ->state([
                    'type_id' => $subscriptionType->id,
                    'project_id' => $this->project->id
                ]), 'valuable')
             ->create();
        
        $this->assertCount(2,$this->project->resourceTypes());
        
    }
    
    /** @test */
    public function resources_as_equipment_can_be_filtered_by_model() {
        
        $this->withoutExceptionHandling();
        
        $equipmentType = ResourceType::factory()->create(['name'=>'Capital']);
        
        Equipment::factory()
            ->count(5)
            ->has(Resource::factory()
            ->state([
                'type_id' => $equipmentType->id,
                'project_id' => $this->project->id
                ]), 'valuable')
            ->create();
        
         $name =  'Canon camera r5';
         $equipment = Equipment::factory()
             ->state(['model' => $name])
             ->has(Resource::factory()
             ->state([
                'type_id' => $equipmentType->id,
                'project_id' => $this->project->id
                 ]), 'valuable')
             ->create();
        
        $result = Resource::filter(Equipment::class, compact('name'))->get();

        $this->assertCount(1, $result->toArray());
        
        $this->assertEquals($equipment->id, $result[0]->valuable_id);
    }
    
    /** @test */
    public function resources_can_be_filtered_by_type() {
        
        $this->withoutExceptionHandling();
        
        $type1 = ResourceType::factory()->create(['name'=>'Human']);
        $type2 = ResourceType::factory()->create(['name'=>'Capital']);
        
        Equipment::factory()
            ->count(5)
            ->has(Resource::factory()
            ->state([
                'type_id' => $type1->id,
                'project_id' => $this->project->id
                ]), 'valuable')
            ->create();
        
        Equipment::factory()
            ->count(2)
            ->has(Resource::factory()
            ->state([
                'type_id' => $type2->id,
                'project_id' => $this->project->id
                ]), 'valuable')
            ->create();
            
        $result = Resource::filter(Equipment::class,['type' => $type2->id])->get();
        
        $this->assertCount(2, $result->toArray());
      
    }
}
