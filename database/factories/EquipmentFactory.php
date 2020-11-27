<?php

namespace Database\Factories;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Equipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->word,
            'type'=> $this->faker->word,
            'model' =>$this->faker->words(5, true),
            'cost'=> $this->faker->randomFloat(2, 1, 200000)
        ];
    }
}
