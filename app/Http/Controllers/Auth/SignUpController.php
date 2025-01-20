<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    public function index()
    {
        return inertia('Auth/SignUp');
    }

    public function store(SignUpRequest $request)
    {
        $user = User::create($request->validated());

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->intended();
    }
}
