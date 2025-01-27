<?php

namespace App\Providers;

use App\Models\Organization;
use App\Observers\OrganizationObserver;
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
