<?php

namespace App\Listeners;

use App\Events\OrganizationJoinRequested;
use App\Mail\OrganizationJoinRequestMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrganizationJoinRequestNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrganizationJoinRequested $event): void
    {
        $creator = User::where('id', $event->organization->creator_id)->first();

        $this->sendJoinRequestedEmail($creator, $event);
    }

    protected function sendJoinRequestedEmail(User $user, $event) {
        Mail::to($user->email)->queue(new OrganizationJoinRequestMail($event->user, $event->organization));
    }
}
