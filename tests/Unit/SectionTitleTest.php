<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\SectionTitle;
use App\Http\Controllers\SectionTitleController;

class SectionTitleTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    private $code;
    private $section;
    public $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->code = $this->faker->word;
        $this->section = SectionTitle::factory()->create(['code' => $this->code]);
        
    }
    
    /** @test */
    public function it_can_be_added_to_database()
    {
        $this->withoutExceptionHandling();

        $this->assertDatabaseHas('section_titles',[
                'code' => $this->code,
                'title' => $this->section->title
        ]);
    }
      
    /** @test */
    public function title_can_be_found_by_route_name()
    {
        $section = SectionTitle::where('code', $this->code)->firstOrFail();
        
        $this->assertInstanceOf(SectionTitle::class, $section);
        $this->assertEquals($this->section->title, $section->title);
    }
}
