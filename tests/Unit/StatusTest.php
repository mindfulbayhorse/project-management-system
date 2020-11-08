<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Status;

class StatusTest extends TestCase
{
    /** @test */
    public function it_has_a_path()
    {
        $status = factory(Status::class)->create();
        
        $this->assertEquals('/statuses/'.$status->id, $status->path());
        
    }
}
