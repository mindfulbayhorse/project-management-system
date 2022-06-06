<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\ResourceType;
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
            'model' =>$this->faker->words(5, true),
            'manufacturer'=> $this->faker->word,
            'cost'=> $this->faker->randomNumber(2, 200000)
        ];
    }
}
