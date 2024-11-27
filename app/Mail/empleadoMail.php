<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class empleadoMail extends Mailable
{   
    public $email;
    public $password;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $password)
    {
        $this->email= $email;
        $this->password= $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('shop@ozez.store', 'ozez'),
            subject: 'Empleado Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.mailEmpleado',
            with:[
                'header'=>'BIenvenido a nuestro equipo Ozez',
                'slot'=>'Gracias por registrarte. Estamos emocionados de que te unas a nosotros.',
                'email'=>$this->email,
                'password'=>$this->password,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
