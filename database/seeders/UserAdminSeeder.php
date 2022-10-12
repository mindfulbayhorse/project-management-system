<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;
use App\Models\Role;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        $users = User::where('email', 'developer@gmail.com')->get();

        //create role admin
        $admin = Role::factory()->state(['name' => 'admin'])->create();

        if ($users->count()==0){
            $user = User::factory()
            ->state([
                'email' => 'developer@gmail.com',
                'password' => Hash::make(env('DEV_ADMIN_PASSWORD')),
                'email_verified_at' => now()
            ])
            ->hasAttached($admin)
            ->create();
        } else {
            
            //give user this role
            $users->first()->assignRole($admin);
        }
    }
}
