<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\WorkBreakdownStructure;
use Faker\Generator as Faker;
use App\User;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'user_id' => factory(User::class)
    ];
});