<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ordenMail extends Mailable
{
    public $numeroPedido;
    public $productos;
    public $total;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($numeroPedido, $productos, $total)
    {
        $this->numeroPedido = $numeroPedido;
        $this->productos = $productos;
        $this->total = $total;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('shop@ozez.store', 'ozez'),
            subject: 'Gracias por tu compra',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.orden',
            with: [
                'numeroPedido' => $this->numeroPedido,
                'productos' => $this->productos,
                'total' => $this->total,
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
