<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SectionTitle;
use App\Models\User;

class ManagingBreadcrumbsTest extends TestCase
{
    use RefreshDatabase;
    
    public $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user  = User::factory()->create();
        
        $this->signIn($this->user);
    }
    
    /** @test */
    public function it_can_show_section_title()
    {
        $this->withoutExceptionHandling();
        
        SectionTitle::factory()->create([
            'code'=>'candidates.index',
            'title' => 'Candidates'
        ]);
        
        $section = SectionTitle::where('code','candidates.index')->get()->first();
        
        $this->actingAs($this->user)->get('/candidates')
            ->assertViewHas('section', $section);
    }
      
    /** @test */
    public function it_can_be_created_on_admin_page()
    {
        
        $this->withoutExceptionHandling();
        
        $newSectionTitle = SectionTitle::factory()->raw();
        
        $this->get('admin/sections/create')
            ->assertStatus(200);
        
        $this->actingas($this->user)->followingRedirects()
            ->post('admin/sections', $newSectionTitle)
            ->assertStatus(200);
        
        $this->assertDatabaseHas('section_titles', $newSectionTitle);

    }

}
