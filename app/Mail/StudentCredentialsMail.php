<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $studentName,
        public string $username,
        public string $password,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Welcome to Arabic Pro — Your Login Details',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.student-credentials',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('files/arabic-pro-course.pdf'))
                ->as('Arabic Pro Course.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
