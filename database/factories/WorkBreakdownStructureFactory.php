<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WorkBreakdownStructure;
use Faker\Generator as Faker;
use App\Project;

$factory->define(WorkBreakdownStructure::class, function (Faker $faker) {
    return [
        'project_id' => factory(Project::class)  
    ];
});
