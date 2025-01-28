<?php

use App\Events\OrganizationJoinRequested;
use App\Http\Middleware\HandleInertiaRequests;
use App\Listeners\SendOrganizationJoinRequestNotification;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
        $middleware->redirectGuestsTo('/signin');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();