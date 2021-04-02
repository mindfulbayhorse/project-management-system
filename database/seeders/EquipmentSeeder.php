<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResourceType;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Equipment::factory()
            ->count(150)
            ->has(ResourceType::factory(), 'type')
            ->create();
    }
}
