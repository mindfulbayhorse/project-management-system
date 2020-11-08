<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Status;

class ManagingProjectStatusesTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public $user;
    
    /** @test */
    public function users_can_updated_a_status()
    {
        
        $this->signIn();
        
        $status = factory(Status::class)->create();
        
        $statusChangings = factory(Status::class)->raw();
        
        $this->get($status->path())->assertSee($status->attributesToArray()['name']);
        $this->patch($status->path(), $statusChangings);
        
        $this->assertDatabaseHas('statuses', [
            'id' => $status->id,
            'name' => $statusChangings['name'],
            'description' => $statusChangings['description']
        ]);
    }
}
