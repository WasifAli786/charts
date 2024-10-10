<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifiedController extends Controller
{
    public function create()
    {
        if (Auth::user()->email_verified_at != null) {
            return redirect('/dashboard');
        }
        return view('verify-email');
    }

    public function resend()
    {
        if (Auth::user()->email_verified_at != null) {
            return redirect('/dashboard');
        }

        event(new Registered(Auth::user()));

        return view('verify-email');
    }
}
