<?php

use App\Http\Controllers\Auth\SignInController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index');
})->name('index');

Route::middleware('guest')->group(function () {
   Route::get('/signin', [SignInController::class, 'index'])->name('signin');
});
