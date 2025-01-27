<?php

namespace App\Mail;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrganizationJoinRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requester;
    public $organization;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Organization $organization)
    {
        $this->requester = $user;
        $this->organization = $organization;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Organization Join Request Mail from {$this->requester->name}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.organization-join-request-mail',
            with: [
                'requesterName' => $this->requester->name,
                'requesterEmail' => $this->requester->email,
                'organization' => $this->organization,
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
