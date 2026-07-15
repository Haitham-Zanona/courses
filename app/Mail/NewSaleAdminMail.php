<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewSaleAdminMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $studentName,
        public string $studentEmail,
        public string $orderId,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💰 New Sale — Obada-Ar Course ($49)',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-sale-admin',
        );
    }
}
