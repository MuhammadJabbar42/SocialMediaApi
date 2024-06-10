<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationReminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @param  string  $verificationCode
     * @return void
     */
    public function __construct($verificationUrl)
    {
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email Verification')
                    ->view('EmailVerifyReminder')
                    ->with(['verificationUrl' => $this->verificationUrl]);

    }
}

