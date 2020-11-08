<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resource;
use Faker\Generator as Faker;
use App\Models\User;

$factory->define(Resource::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
    	'type_id' => factory(ResouceType::Class)->create()->id,
    	'valuable_id' => factory(User::Class)->create()->id,
    	'valuable_type' => User::Class
    ];
});
