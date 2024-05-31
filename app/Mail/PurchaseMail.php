<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public array $metadataforEmail;
    public $total;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $metadata, $total)
    {
        $this->user = $user;
        $this->metadataforEmail = $metadata;
        $this->total = $total;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Successful',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.PurchaseEmail',
            with: [
                'metadata' => $this->metadataforEmail,
                'total' => $this->total,
            ],
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
