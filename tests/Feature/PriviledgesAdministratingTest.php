<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;

class PriviledgesAdministratingTest extends TestCase
{
    public $user;
    
    protected function setUp(): void
    {
      parent::setUp();
        
      $this->signIn(); 
    }
    
    
    /**
     * @test
     */
    public function registered_user_can_add_role()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get(route('roles.create'));
        $response->assertStatus(200);
        
        $role = Role::factory()->make()->ToArray();
        
        $saving = $this->post(route('roles.index'), $role);

        $saving->assertStatus(200);
        $this->assertDatabaseHas('roles', $role);
    }
    
    /** @test */
    public function session_has_errors_when_fields_are_empty()
    {
        
        $role = ['name'=>'', 'label'=>''];
        
        $response = $this->post(route('roles.index'), $role);
        
        $response->assertSessionHasErrors(['name', 'label']);
        
        
    }
}
