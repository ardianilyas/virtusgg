<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Dashboard\DashboardIndexController;
use App\Http\Controllers\Dashboard\OrganizationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index');
})->name('index');

// Routes for signin and signup
Route::middleware('guest')->group(function () {
   Route::get('/signin', [SignInController::class, 'index'])->name('signin');
   Route::post('/signin', [SignInController::class, 'authenticate'])->name('signin.authenticate');
   Route::get('/signup', [SignUpController::class, 'index'])->name('signup');
   Route::post('/signup', [SignUpController::class, 'store'])->name('signup.store');
});

// Routes for logout and email verification
Route::middleware('auth')->group(function () {
  Route::post('/logout', [SignInController::class, 'logout'])->name('logout');
  Route::get('/email/verify', [EmailVerificationController::class, 'verificationNotice'])->name('verification.notice');
  Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
  Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['throttle:5,1'])->name('verification.send');

});

// Routes for reset password
Route::middleware('guest')->group(function () {
  Route::get('/password/reset', [ResetPasswordController::class, 'create'])->name('password.request');
  Route::post('/password/email', [ResetPasswordController::class, 'store'])->name('password.email');
  Route::get('/password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.reset');
  Route::post('/password/reset', [ResetPasswordController::class, 'update'])->name('password.update');
});

// Dashboard routes
Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
   Route::get('/', [DashboardIndexController::class, 'index'])->name('index');

   // Route organizations
   Route::resource('organizations', OrganizationController::class);
   Route::post('/organization/request', [OrganizationController::class, 'request'])->name('organization.request');
   Route::post('/organizations/join', [OrganizationController::class, 'join'])->name('organizations.join');
   Route::get('/organization/{organization}/requests', [OrganizationController::class, 'requests'])->name('organization.requests');

   Route::get('/request-join/{requestJoin}/{status}', [OrganizationController::class, 'changeStatus'])->name('organization.changeStatus');
});
