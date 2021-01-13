<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\User;

class ProjectFactory extends Factory
{
    protected $model = Project::class;
    
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
        ];
    }
    
}
