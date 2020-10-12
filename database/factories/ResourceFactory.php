<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Resource;
use Faker\Generator as Faker;
use App\User;

$factory->define(Resource::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
    	'type_id' => factory(ResouceType::Class)->create()->id,
    	'valuable_id' => factory(User::Class)->create()->id,
    	'valuable_type' => User::Class
    ];
});
