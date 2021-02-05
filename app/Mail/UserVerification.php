<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class UserVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $verificationUrl;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $link, Int $id)
    {
        $this->verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $id,
                'hash' => sha1($link),
            ]
            );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.verify')
            ->with([
                'linkHash' => $this->verificationUrl,
            ]);
    }
    
}
