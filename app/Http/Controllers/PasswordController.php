<?php

namespace App\Http\Controllers;

use App\Rules\CurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PasswordController extends Controller
{
    public function create()
    {
        return view('profile.changePassword');
    }

    public function update(Request $request)
    {
            $request->validate([
                'old' => ['required', new CurrentPassword],
                'new' => ['required', 'min:8']
            ]);

            $request->user()->fill([
                'password' => $request->input('new')
            ]);

            try {
                $request->user()->save();
                return Redirect::route('profile.edit')->with('success', 'Password updated successfully!');
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
                return Redirect::route('profile.edit')->with('error', 'Failed to update password!');
            }
    }
}
