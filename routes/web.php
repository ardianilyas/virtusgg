<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index');
})->name('index');

Route::middleware('guest')->group(function () {
   Route::get('/signin', [SignInController::class, 'index'])->name('signin');
   Route::post('/signin', [SignInController::class, 'authenticate'])->name('signin.authenticate');
   Route::get('/signup', [SignUpController::class, 'index'])->name('signup');
   Route::post('/signup', [SignUpController::class, 'store'])->name('signup.store');
});

Route::middleware('auth')->group(function () {
  Route::post('/logout', [SignInController::class, 'logout'])->name('logout');
  Route::get('/email/verify', [EmailVerificationController::class, 'verificationNotice'])->name('verification.notice');
  Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
  Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['throttle:5,1'])->name('verification.send');
});
