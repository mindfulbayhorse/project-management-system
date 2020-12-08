<?php

namespace Database\Factories;

use App\Models\Deliverable;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliverableFactory extends Factory
{
    protected $model = Deliverable::class;
    
    public function definition()
    {
        return [ 
            'title' => $this->faker->word,
            'order' => $this->faker->randomNumber(1)
        ];
    }
     
}
