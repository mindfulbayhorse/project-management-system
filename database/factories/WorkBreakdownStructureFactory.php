<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WorkBreakdownStructure;
use App\Models\Project;

class WorkBreakdownStructureFactory extends Factory
{
    protected $model = WorkBreakdownStructure::class;
    
    public function definition()
    {
        return [
            'project_id' => Project::factory()
        ];
    }
    
}
