<?php

namespace Database\Factories;

use App\Models\SectionTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionTitleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SectionTitle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'code' => $this->faker->word
        ];
    }
}
