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
            subject: '🎉 Welcome to Obada-Ar — Your Login Details',
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
        $filePath = public_path('files/arabic-pro-course.pdf');

        // نتحقق من وجود الملف قبل محاولة إرفاقه لتجنب انهيار الموقع بعد الدفع
        if (file_exists($filePath)) {
            return [
                Attachment::fromPath($filePath)
                    ->as('Obada-Ar Course.pdf')
                    ->withMime('application/pdf'),
            ];
        }

        return [];
    }
}