<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (string) $user->id === (string) $id;
});

Broadcast::channel('request.join.{userId}', function (User $user, $userId) {
   return (string) $user->id === (string) $userId;
});