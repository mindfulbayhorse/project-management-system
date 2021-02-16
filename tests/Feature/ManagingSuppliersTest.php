<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Supplier;

class ManagingSuppliersTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
    }
    
    /** @test */
    public function authenticated_user_can_add_supplier()
    {
        $this->withoutExceptionHandling();
        
        $supplier = Supplier::factory()->raw();
        
        $this->actingAs($this->user)->get(route('suppliers.create'))
            ->assertStatus(200)
            ->assertDontSee($supplier['name']);
        
        tap($supplier, function($supplier){
            
            $this->assertDatabaseMissing('suppliers', $supplier);
            
            $this->actingAs($this->user)->followingRedirects()
                ->post(route('suppliers.index'), $supplier)
                ->assertStatus(200);
            
            $id = Supplier::where([
               'name'=>$supplier['name'],
               'url'=>$supplier['url']
            ])->get()->first();
            
           $this->actingAs($this->user)->get(route('supplier',$id))
                ->assertStatus(200)
                ->assertSee($supplier['name']);
            
            $this->assertDatabaseHas('suppliers', $supplier);
        });
        
    }
    
    /** @test */
    public function guests_cannot_add_new_supplyer()
    {
        $this->get(route('suppliers.create'))
            ->assertRedirect('/login');
        
        $supplyer = Supplier::factory()->raw();
        $this->post(route('suppliers.index'), $supplyer)
            ->assertRedirect('/login');
    }
    
    /** @test */
    public function authenticated_user_can_delete_supplyer()
    {
        
        $supplyer = Supplier::factory()->create();
        
        $this->assertDatabaseHas('suppliers', $supplyer->toArray());
        
        $this->actingAs($this->user)
            ->delete(route('suppliers.destroy', $supplyer), $supplyer->toArray());
        
        $this->assertDatabaseMissing('suppliers', $supplyer->toArray());
    }
    
    /** @test */
    public function authenticated_user_can_change_supplyer()
    {
        $this->withoutExceptionHandling();
        
        $supplyer = Supplier::factory()->create();
        
        $this->assertDatabaseHas('suppliers', $supplyer->toArray());
        
        $nameOld = $supplyer->name;
        $supplyer->update(['name' => $this->faker->company]);

        
        $this->actingAs($this->user)
            ->patch($supplyer->path(), $supplyer->toArray())
            ->assertStatus(200);
        
            $this->assertDatabaseMissing('suppliers', [
                'name' => $nameOld,
                'id' => $supplyer->id
        ]);
            
        $this->assertDatabaseHas('suppliers', $supplyer->toArray());
    }
}
