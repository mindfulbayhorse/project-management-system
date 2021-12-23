<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Status;

class ManagingProjectStatusesTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public $user;
    
    /** @test */
    public function it_can_be_created()
    {
        
        $this->signIn();
        
        $status = Status::factory()->make()->toArray();
        $this->assertDatabaseMissing('statuses', $status);
        
        $response = $this->followingRedirects()->post(route('statuses.index',$status));
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('statuses', $status);
    }
    
    /** @test */
    public function it_can_be_updated()
    {
        
        $this->signIn();
        
        $status = Status::factory()->create();
        
        $statusChangings = Status::factory()->raw();
        
        $this->get($status->path())->assertSee($status->attributesToArray()['name']);
        $this->patch($status->path(), $statusChangings);
        
        $this->assertDatabaseHas('statuses', [
            'id' => $status->id,
            'name' => $statusChangings['name'],
            'description' => $statusChangings['description']
        ]);
    }
}
