<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    
    public function signIn($user = null){
        
        if (!$user){
            $user = User::factory()->create();
        }
        
        $this->user = $user;
        
        return $this->actingAs($this->user);
        
    }
}
