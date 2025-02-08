<?php

namespace App\Observers;

use App\Models\Organization;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrganizationObserver
{
    /**
     * Handle the Organization "created" event.
     */
    public function created(Organization $organization): void
    {
        $organization->code = strtoupper(Str::random(6));
        if ($organization->image) {
            $organization->image_path = asset('storage/organizations/' . $organization->image);
        }

        while (Organization::where('code', $organization->code)->exists()) {
            $organization->code = strtoupper(Str::random(6));
        }

        $organization->save();
    }

    /**
     * Handle the Organization "updated" event.
     */
    public function updated(Organization $organization): void
    {

    }

    /**
     * Handle the Organization "deleted" event.
     */
    public function deleted(Organization $organization): void
    {
        $filePath = 'organizations/' . $organization->image;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }

    /**
     * Handle the Organization "restored" event.
     */
    public function restored(Organization $organization): void
    {
        //
    }

    /**
     * Handle the Organization "force deleted" event.
     */
    public function forceDeleted(Organization $organization): void
    {
        //
    }
}
