<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resource;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\ResourceType;

class ResourceFactory extends Factory
{
    protected $model = Resource::class;
    
    public function definition()
    {
        return [
        	'type_id' => ResourceType::factory()->create()->id,
        	'valuable_id' => User::factory()->create()->id,
        	'valuable_type' => User::Class
        ];
    }
}