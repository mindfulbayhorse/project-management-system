<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\MailTrack;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use MailTrack;
    
    /** @test */
    public function mailIsSendForResettingThePassword()
    {
        Mail::raw('Feed is updated', function($message){
            $message->to('foo@bar.com');
            $message->from('foofoo@bar.com');
        });
        
        $this->seeEmailSentTo('foo@bar.com')
            ->seeEmailSentFrom('foofoo@bar.com')
            ->seeEmailEquals('Feed is updated')
            ->seeEmailContains('Feed');
    }
}
