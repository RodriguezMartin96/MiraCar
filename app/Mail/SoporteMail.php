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

    public function __construct($data)
    {
        $this->fromEmail = $data['fromEmail'];
        $this->asunto = $data['asunto'];
        $this->descripcion = $data['descripcion'];
        $this->tallerName = $data['tallerName'] ?? null;
        $this->toEmail = $data['toEmail'] ?? 'adm.96.rrm@gmail.com';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Soporte MiraCar: ' . $this->asunto,
            from: new Address('soporte@miracar.com', 'Soporte MiraCar'),
            replyTo: [new Address($this->fromEmail, $this->tallerName ?? 'Usuario MiraCar')]
        );
    }

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

    public function attachments(): array
    {
        return [];
    }
}