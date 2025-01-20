<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verificationNotice()
    {
        return inertia('Auth/VerificationNotice');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->to('/');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back();
    }
}
