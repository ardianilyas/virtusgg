<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function index()
    {
        return inertia('Auth/SignIn');
    }

    public function authenticate(SignInRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            $request->session()->regenerate();
            return redirect()->intended();
        } else {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->intended();
    }
}
