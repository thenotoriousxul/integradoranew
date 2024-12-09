<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnvioEntregado extends Mailable
{
    use Queueable, SerializesModels;

    public $envio;

    /**
     * Create a new message instance.
     */
    public function __construct($envio)
    {
        $this->envio = $envio;
    }

    /**

     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('shop@ozez.store', 'ozez'),
            subject: '¡Tu envío ha sido entregado!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.mailEnvioEntregado',
            with: [
                'envio' => $this->envio,
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
