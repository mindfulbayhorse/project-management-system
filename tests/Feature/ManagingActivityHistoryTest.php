<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\WorkBreakdownStructure;
use App\Models\Project;
use App\Models\Deliverable;

class ManagingActivityHistoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $deliverable;
    public $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->signIn();
        
        $this->deliverable = Deliverable::factory()
            ->for(WorkBreakdownStructure::factory(),'wbs')
            ->create();
    }
    
    /** @test */
    public function wbs_has_deliverable_created_history()
    {
        
        $this->actingAs($this->user)
            ->get($this->deliverable->wbs->path())
            ->assertSee('deliverable is created');
    }
    
    /** @test */
    public function wbs_has_deliverable_updated_history()
    {
        
        $oldTitle = $this->deliverable->title;
        $newTitle = $this->faker->word;
        
        $this->deliverable->update(['title' => $newTitle]);        
        
        $this->actingAs($this->user)
            ->get($this->deliverable->wbs->path())
            ->assertSeeText('The title of deliverable is changed from '
                .$oldTitle.' to '.$newTitle
       );  
    }
}
