<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\WorkBreakdownStructure;
use App\Models\Deliverable;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (User::where('email','developer@gmail.com')->get()->count()==0){
            User::factory()->create([
                'email'=>'developer@gmail.com',
                'password' => Hash::make(env('DEV_ADMIN_PASSWORD')),
                'email_verified_at' => now()
            ]);
        }
       

    }
}
