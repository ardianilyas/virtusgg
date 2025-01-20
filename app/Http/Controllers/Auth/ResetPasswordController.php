<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function create()
    {
        return inertia('Auth/ForgotPassword');
    }

    public function store(ResetPasswordRequest $request)
    {
        $status = Password::sendResetLink($request->only('email'));

        if($status !== Password::RESET_LINK_SENT) {
            return back()->withErrors(['email' => trans($status)]);
        }

        return back()->with('status', trans($status));
    }

    public function reset(Request $request, $token)
    {
        return inertia('Auth/ResetPassword', compact('token'));
    }

    public function update(ForgotPasswordRequest $request)
    {
        $status = Password::reset($request->only('email', 'password', 'token'), function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password),
                'remember_token' => Str::random(60),
            ])->save();
            event(new PasswordReset($user));
        });

        if($status !== Password::PASSWORD_RESET) {
            return back()->withErrors(['email' => trans($status)]);
        }

        return redirect()->route('signin')->with('status', trans($status));
    }
}
