<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ResourceType;

class ResourceTypeFactory extends Factory
{
    protected $model = ResourceType::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2)
        ];
    }
    
}

