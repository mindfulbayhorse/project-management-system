<?php

namespace Database\Factories;

use App\Models\Supplyer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplyerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplyer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'url' => $this->faker->url
        ];
    }
}
