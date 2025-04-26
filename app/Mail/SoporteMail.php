<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SoporteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fromEmail;
    public $asunto;
    public $descripcion;
    public $tallerName;

    /**
     * Create a new message instance.
     */
    public function __construct($fromEmail, $asunto, $descripcion, $tallerName = null)
    {
        $this->fromEmail = $fromEmail;
        $this->asunto = $asunto;
        $this->descripcion = $descripcion;
        $this->tallerName = $tallerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Soporte MiraCar: ' . $this->asunto,
            from: new Address($this->fromEmail, 'Sistema MiraCar'),
            replyTo: [new Address($this->fromEmail)]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.soporte',
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