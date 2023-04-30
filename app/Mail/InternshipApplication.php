<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InternshipApplication extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $status;

    public function __construct($name, $status)
    {
        $this->name = $name;
        $this->status = $status;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengajuan Magang',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->status == 2) {
            return new Content(
                view: 'email.approve',
                with: ['name' => $this->name],
            );
        }

        if ($this->status == 3) {
            return new Content(
                view: 'email.reject',
                with: ['name' => $this->name],
            );
        }
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
