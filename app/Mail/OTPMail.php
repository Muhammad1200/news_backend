<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data = [];
    protected $email;
    protected $name;
    protected $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$name,$otp)
    {
        $this->data = [
            'email' => $email,
            'name' => $name,
            'otp' => $otp
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        $data['email'] = $this->email;
//        $data['name'] = $this->name;
//        $data['otp'] = $this->otp;
        return $this->markdown('emails.otpmail',$this->data);
    }
}
