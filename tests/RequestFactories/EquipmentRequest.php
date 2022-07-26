<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class EquipmentRequest extends RequestFactory
{
    
    public function definition(): array
    {
        return [
           'model' => $this->faker->words(50, true),
           'manufacturer'=> $this->faker->words(2, true),
           'cost' => $this->faker->randomNumber(5, true)
        ];
    }
}
