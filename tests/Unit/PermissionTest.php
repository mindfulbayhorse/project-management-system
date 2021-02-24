<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\Permission;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_assigned_to_user()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();

        $this->assertEmpty($user->permissions());
        
        $role = Role::factory()
            ->hasPermissions(2)
            ->create();
        
        $user->assignRole($role);
        $user->refresh();

        $this->assertNotEmpty($user->permissions());
        $this->assertCount(2,$user->permissions());
        
    }

}
