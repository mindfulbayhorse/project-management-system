<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deliverable;
use Faker\Generator as Faker;

$factory->define(Deliverable::class, function (Faker $faker) {
    return [
    	'title' => $faker->sentence(3, true)
    ];
});
