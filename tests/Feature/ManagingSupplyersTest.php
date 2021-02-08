<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Supplyer;

class ManagingSupplyersTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function authenticated_user_can_add_supplyer()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();
        $supplyer = Supplyer::factory()->raw();
        
        $this->actingAs($user)->get(route('supplyers.create'))
            ->assertStatus(200)
            ->assertDontSee($supplyer['name']);
        
        tap($supplyer, function($supplyer) use ($user){
            
            $this->assertDatabaseMissing('supplyers', $supplyer);
            
            $this->actingAs($user)->followingRedirects()
                ->post(route('supplyers.index'), $supplyer)
                ->assertStatus(200);
            
            $id = Supplyer::where([
               'name'=>$supplyer['name'],
               'url'=>$supplyer['url']
            ])->get()->first();
            
           $this->actingAs($user)->get(route('supplyer',$id))
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
}
