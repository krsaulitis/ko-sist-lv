<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuditionSubmissionApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly string $password)
    {

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pieteikums apstiprināts',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'submissions.mail.approved',
        );
    }
}
