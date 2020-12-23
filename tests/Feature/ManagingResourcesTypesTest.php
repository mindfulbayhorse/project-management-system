<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ResourceType;

class ManagingResourcesTypesTest extends TestCase
{
    public $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->signIn();
    }
    
    /** @test */
    public function authenticated_user_can_add_resource_type()
    {
        $this->withoutExceptionHandling();
        
        $resourceType = ResourceType::factory()->raw();
        
        $this->actingAs($this->user)->post('/resources_types', $resourceType);
        
        $this->assertDatabaseHas('resource_types', $resourceType);
    }
}
