<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
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
});
