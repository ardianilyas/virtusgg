<?php

namespace App\Providers;

use App\Events\OrganizationJoinRequested;
use App\Listeners\SendOrganizationJoinRequestNotification;
use App\Models\Organization;
use App\Observers\OrganizationObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Organization::observe(OrganizationObserver::class);
    }
}
