<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ResourceType;
use Faker\Generator as Faker;

$factory->define(ResourceType::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2)
    ];
});
