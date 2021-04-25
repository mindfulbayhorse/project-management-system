<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service'=> $this->faker->words(5, true),
            'start_date' => $this->faker->dateTime(),
            'end_date'=> $this->faker->dateTime(),
            'renewable' =>$this->faker->boolean()
        ];
    }
}
