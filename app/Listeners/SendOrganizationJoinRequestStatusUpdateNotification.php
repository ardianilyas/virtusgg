<?php

namespace App\Listeners;

use App\Events\OrganizationJoinRequestStatusUpdate;
use App\Mail\OrganizationJoinRequestUpdateMail;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrganizationJoinRequestStatusUpdateNotification
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
    public function handle(OrganizationJoinRequestStatusUpdate $event): void
    {
        Mail::to($event->user->email)->queue(new OrganizationJoinRequestUpdateMail($event->user, $event->organization, $event->status));
    }
}