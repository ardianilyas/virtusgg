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

class OrganizationJoinRequestUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $organization;
    public $status;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Organization $organization, $status)
    {
        $this->user = $user;
        $this->organization = $organization;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Organization Join Request Update Mail for {$this->organization->name}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.organization-join-request-update-mail',
            with: [
                'user' => $this->user,
                'organization' => $this->organization,
                'status' => $this->status,
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
