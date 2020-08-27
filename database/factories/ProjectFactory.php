<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\WorkBreakdownStructure;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->name
    ];
});

$factory->afterCreating(Project::class, function ($project, $faker) {
        $project->wbs()->save(factory(WorkBreakdownStructure::class)->make(['actual'=>true]));
});