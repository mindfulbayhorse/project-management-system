<?php

namespace Tests\Feature\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Equipment;

class ResourceEquipmentTest extends TestCase
{
    /** @test */
    public function it_can_be_added_to_project()
    {
        $equipment = Equipment::factory()->create();
    }
}
