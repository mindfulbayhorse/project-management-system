<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResourceType;
use App\Models\Equipment;
use App\Models\Project;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::truncate();
        
        Equipment::factory()
            ->count(150)
            ->create();
        
        $this->makeEquipmentAsResource();
    }
    
    public function makeEquipmentAsResource(){
        
        $project = Project::all()->first();
        $type = ResourceType::all()->first();
        $equipment  = Equipment::all()->take(10);
        
        if (!$type || !$project) return;
        
        foreach ($equipment as $item){
            $item->assignTo($project, $type->id);
        }

    }
   
}
