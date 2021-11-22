<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\MailTrack;
use Tests\TestCase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    use MailTrack, RefreshDatabase, WithFaker;
    
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
    
    /** @test */
    public function user_cannot_sing_up_without_agreement()
    {
        //get request to register page
        $respond = $this->get(route('register'));
        $respond->assertStatus(200)->assertSeeText('Agree with terms and conditions');
        
        $password = $this->faker()->uuid();
        
        $user = [
            'email'=>$this->faker()->email(),
            'password' => $password,
            'password_confirmation' => $password
        ];
        
        //checking checkbox field in the form        
        $respond = $this->post(route('register'), $user);
        $respond->assertSessionHasErrors('agreement');

        //checking new user in DB
    }
    
    
    /** @test */
    public function user_can_sing_up_with_agreement()
    {
        //get request to register page        
        $password = $this->faker()->uuid();
        
        $user = [
            'email'=>$this->faker()->email(),
            'password' => $password,
            'password_confirmation' => $password,
            'agreement' => true
        ];
        
        //checking checkbox field in the form
        $this->post(route('register'), $user);
                
        //checking new user in DB
        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }
}
