<?php

namespace Database\Factories;

use App\Models\Deliverable;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WorkBreakdownStructure;

class DeliverableFactory extends Factory
{
    protected $model = Deliverable::class;
    
    public function definition()
    {
        return [ 
            'title' => $this->faker->word,
            'wbs_id' => WorkBreakdownStructure::factory(),
            'start_date' => $this->faker->dateTimeBetween('-1 month', '+1month'),
            'end_date' => $this->faker->dateTimeThisYear('+2 months')
        ];
    }
     
}
