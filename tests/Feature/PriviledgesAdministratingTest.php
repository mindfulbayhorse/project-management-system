<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;

class PriviledgesAdministratingTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
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
        //dd($role['name']);
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
    
    
    /** @test */
    public function user_can_see_list_of_all_roles()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get(route('roles.index'));
        $response->assertStatus(200);
        
        $roles = Role::factory()->count(2)->create();
        
        $response = $this->get(route('roles.index'));

        $response->assertSeeInOrder($roles->pluck('label')->toArray());
    }
    
    /** @test */
    public function user_can_edit_role()
    {
        $this->withoutExceptionHandling();
        
        $role = Role::factory()->create();
        
        $response = $this->get(route('roles.edit',['role' => $role]));
        $response->assertStatus(200)->assertSee($role->name);
        
        $changes = [
            'id' => $role->id ,
            'name' => 'new-name',
            'label' => 'new label'
        ];
        
        $response = $this->patch(route('roles.update', ['role' => $role]), $changes);
        
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('roles', $changes);
    }
    
    
    /** @test */
    public function user_can_open_role_page()
    {
        $role = Role::factory()->create();
        
        $response = $this->get(route('roles.show',['role' => $role]));
        $response->assertStatus(200)->assertSee('<h1>'.$role->label.'</h1>', false);
    }
    
    
    /** @test */
    public function name_must_consist_of_symbols()
    {
        
        $role = Role::factory()->make(['name'=>'admin2'])->toArray();
        $response = $this->post(route('roles.index', ['role' => $role]));
  
        $response->assertSessionHasErrors(['name']);
    }
    
    /** @test */
    public function name_must_be_unique_through_table()
    {
      
        Role::factory()->create(['name'=>'admin']);
        $role2 = Role::factory()->make(['name'=>'admin'])->toArray();
        $response = $this->post(route('roles.index', ['role' => $role2]));
        $response->assertSessionHasErrors(['name']);
    }
    
}
