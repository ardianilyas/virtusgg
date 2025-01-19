<?php

use App\Http\Controllers\Auth\SignInController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index');
})->name('index');

Route::middleware('guest')->group(function () {
   Route::get('/signin', [SignInController::class, 'index'])->name('signin');
   Route::post('/signin', [SignInController::class, 'authenticate'])->name('signin.authenticate');
});

Route::middleware('auth')->group(function () {
  Route::post('/logout', [SignInController::class, 'logout'])->name('logout');
});
