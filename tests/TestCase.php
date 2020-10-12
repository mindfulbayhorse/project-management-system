<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    public function signIn($user = null){
    	
    	if (!$user){
    		$user = factory(User::class)->create();
    	}
    	
    	$this->user = $user;

    	return $this->actingAs($this->user);
    	
    }
}
