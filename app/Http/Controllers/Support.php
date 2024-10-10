<?php

namespace App\Http\Controllers;

use App\Mail\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Support extends Controller
{
    public function create()
    {
        return view('profile.support');
    }

    public function store(Request $request)
    {
            $subject = $request->subject;
            $body = $request->body;

            $data = ['subject' => $subject, 'body' => $body];

            Mail::to('wasifalidev77777@gmail.com')->send(new Complain($data));

            return redirect('/support')->with('success', 'Complain filed successfully!');
        
    }
}
