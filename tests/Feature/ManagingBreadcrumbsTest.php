<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SectionTitle;

class ManagingBreadcrumbsTest extends TestCase
{
    public $user;
    
    /** @test */
    public function it_can_show_section_title()
    {
        $this->withoutExceptionHandling();
        
        
        $section = SectionTitle::factory()->create([
            'code'=>'candidates.index',
            'title' => 'Candidates'
        ]);
        
        $routeTitle = SectionTitle::where('code','candidates.index')->FirstOrFail();
        
        $this->signIn();
        
        $response = $this->actingAs($this->user)->get('/candidates')
         ->assertViewHas('sectionTitle', $routeTitle->title);
    }
}
