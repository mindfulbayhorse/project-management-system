<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Supplyer;

class ManagingSupplyersTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
    }
    
    /** @test */
    public function authenticated_user_can_add_supplyer()
    {
        $this->withoutExceptionHandling();
        
        $supplyer = Supplyer::factory()->raw();
        
        $this->actingAs($this->user)->get(route('supplyers.create'))
            ->assertStatus(200)
            ->assertDontSee($supplyer['name']);
        
        tap($supplyer, function($supplyer){
            
            $this->assertDatabaseMissing('supplyers', $supplyer);
            
            $this->actingAs($this->user)->followingRedirects()
                ->post(route('supplyers.index'), $supplyer)
                ->assertStatus(200);
            
            $id = Supplyer::where([
               'name'=>$supplyer['name'],
               'url'=>$supplyer['url']
            ])->get()->first();
            
           $this->actingAs($this->user)->get(route('supplyer',$id))
                ->assertStatus(200)
                ->assertSee($supplyer['name']);
            
            $this->assertDatabaseHas('supplyers', $supplyer);
        });
        
    }
    
    /** @test */
    public function guests_cannot_add_new_supplyer()
    {
        $this->get(route('supplyers.create'))
            ->assertRedirect('/login');
        
        $supplyer = Supplyer::factory()->raw();
        $this->post(route('supplyers.index'), $supplyer)
            ->assertRedirect('/login');
    }
    
    /** @test */
    public function authenticated_user_can_delete_supplyer()
    {
        
        $supplyer = Supplyer::factory()->create();
        
        $this->assertDatabaseHas('supplyers', $supplyer->toArray());
        
        $this->actingAs($this->user)
            ->delete(route('supplyers.destroy', $supplyer), $supplyer->toArray());
        
        $this->assertDatabaseMissing('supplyers', $supplyer->toArray());
    }
    
    /** @test */
    public function authenticated_user_can_change_supplyer()
    {
        $this->withoutExceptionHandling();
        
        $supplyer = Supplyer::factory()->create();
        
        $this->assertDatabaseHas('supplyers', $supplyer->toArray());
        
        $nameOld = $supplyer->name;
        $supplyer->update(['name' => $this->faker->company]);

        
        $this->actingAs($this->user)
            ->patch($supplyer->path(), $supplyer->toArray())
            ->assertStatus(200);
        
            $this->assertDatabaseMissing('supplyers', [
                'name' => $nameOld,
                'id' => $supplyer->id
        ]);
            
        $this->assertDatabaseHas('supplyers', $supplyer->toArray());
    }
}
