<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CounsellorCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;

    public function __construct($NIC, $password)
    {
        $this->email = $NIC;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Welcome to Sitharana !')
                    ->view('admin.pages.email.counsellor_credentials');
    }
}