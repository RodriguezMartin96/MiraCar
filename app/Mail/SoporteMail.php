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
    public $toEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->fromEmail = $data['fromEmail'];
        $this->asunto = $data['asunto'];
        $this->descripcion = $data['descripcion'];
        $this->tallerName = $data['tallerName'] ?? null;
        $this->toEmail = $data['toEmail'] ?? 'adm.96.rrm@gmail.com';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Soporte MiraCar: ' . $this->asunto,
            // Usamos una dirección de correo del sistema como remitente para evitar problemas de SPF/DKIM
            from: new Address('soporte@miracar.com', 'Soporte MiraCar'),
            replyTo: [new Address($this->fromEmail, $this->tallerName ?? 'Usuario MiraCar')]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.soporte',
            with: [
                'fromEmail' => $this->fromEmail,
                'tallerName' => $this->tallerName,
                'asunto' => $this->asunto,
                'descripcion' => $this->descripcion,
                'toEmail' => $this->toEmail
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