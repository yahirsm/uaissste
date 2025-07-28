<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $passwordPlain;

    /**
     * Create a new message instance.
     */
    public function __construct(string $username, string $passwordPlain)
    {
        $this->username      = $username;
        $this->passwordPlain = $passwordPlain;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Tus credenciales de acceso')
            ->markdown('emails.credentials')
            ->with([
                'username'      => $this->username,
                'passwordPlain' => $this->passwordPlain,
            ]);
    }
}
