<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class CandidateTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function they_have_first_name_and_surname()
    {
        $firstName = 'Olga';
        $lastName = 'Zhilkova';
        
        $candidate = User::factory()->create([
            'first_name'=> $firstName,
            'last_name' => $lastName
        ]);
        
        $this->assertEquals($firstName, $candidate->first_name);
        $this->assertEquals($lastName, $candidate->last_name);
        
        $this->assertDatabaseHas('users', [
            'first_name' => $firstName,
            'last_name' => $lastName
        ]);
        
    }
    
    
    /** @test */
    public function it_has_a_path()
    {
        $candidate = User::factory()->create();
        
        $this->assertEquals('/candidates/'.$candidate->id, $candidate->path());
    }
}
