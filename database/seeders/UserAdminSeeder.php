<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email'=>'developer@gmail.com',
            'password' => Hash::make(env('DEV_ADMIN_PASSWORD', 'password'))
        ]);
    }
}
