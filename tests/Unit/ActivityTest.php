<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ActivityTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $wbs;
    
    protected function setUp():void
    {
        parent::setUp();
        $this->wbs =  WorkBreakdownStructure::factory()
            ->create();
    }
    
    /** @test */
    public function wbs_is_created()
    {
        $this->withoutExceptionHandling();
        
        tap($this->wbs->activities->last(), function($activity){
            $this->assertEquals('created', $activity->description);
            $this->assertInstanceOf(WorkBreakdownStructure::class, $activity->subject);
        });
        
    }
    
    /** @test */
    public function deliverable_is_created()
    {
        
        Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);
        
        $this->wbs->refresh();

        tap($this->wbs->activityRecords->last(), function($activity){
            
            $this->assertEquals('created_deliverable', $activity->description);
            
            $this->assertInstanceOf(Deliverable::class, $activity->subject);
            $this->assertEquals('', $activity->changes);
            
        });
        
        $this->assertCount(2, $this->wbs->activityRecords);
    }
    
    /** @test */
    public function deliverable_is_updated()
    {
        $this->withoutExceptionHandling();
        
        $deliverable = Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);

        $originalTitle = $deliverable->title;
        
        $newTitle = $this->faker()->sentence;
        
        $deliverable->update(['title' => $newTitle]);
        
        tap($deliverable->activities->last(), function($activity) use 
         ($originalTitle, $newTitle){
            
            $this->assertEquals('updated_deliverable', $activity->description);
            $expected = [
                'before' => ['title' => $originalTitle],
                'after' => ['title' => $newTitle]
            ];

            $this->assertEquals($expected, $activity->changes);
        });
        
        $this->assertCount(3, $this->wbs->activityRecords);
    }
    
    /** @test */
    public function deliverable_is_deleted()
    {
        $this->withoutExceptionHandling();
        
        $deliverable = Deliverable::factory()->create(['wbs_id'=>$this->wbs->id]);
        
        $deliverable->delete();
        
        tap($this->wbs->activityRecords->last(), function($activity){
                
                $this->assertEquals('deleted_deliverable', $activity->description);
        });
        
    }
}
