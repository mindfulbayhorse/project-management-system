<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Status;

class StatusTest extends TestCase
{
    /** @test */
    public function it_has_a_path()
    {
        $status = Status::factory()->create();
        
        $this->assertEquals('/statuses/'.$status->id, $status->path());
        
    }
}
