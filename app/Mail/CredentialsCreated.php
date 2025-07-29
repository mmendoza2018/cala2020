<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CredentialsCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $panelUrl;

    public function __construct($email, $password, $panelUrl)
    {
        $this->email = $email;
        $this->password = $password;
        $this->panelUrl = $panelUrl;
    }

    public function build()
    {
        return $this->subject('Acceso a tu nueva tienda')
            ->view('emails.sendCredentials');
    }
}
