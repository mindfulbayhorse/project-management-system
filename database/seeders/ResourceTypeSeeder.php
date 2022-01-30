<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResourceType;
use App\Models\Equipment;
use App\Models\Resource;

class ResourceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ResourceType::all();
        foreach ($types as $type){
            $type->delete();
        }

        ResourceType::factory()->count(3)->create();
    }
}
