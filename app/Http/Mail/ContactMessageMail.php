<?php

namespace App\Http\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public string $messageContent,
    ) {
    }

    public function build(): self
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Nouveau message de contact')
            ->view('emails.contact_message')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'content' => $this->messageContent,
            ]);
    }
}
