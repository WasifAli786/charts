<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        if (auth()->user()) {
            return redirect('/dashboard');
        }
        return view('index');
    }
}
 