<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertController extends Controller
{
    public function show()
    {
        $subscribed = Auth::user()->subscriptions()->paginate(20);
        $subscribedIds = auth()->user()->subscriptions()->pluck('expert_id');

        $experts = User::where('class', '1')
            ->whereNotIn('id', $subscribedIds)
            ->paginate(10);

        return view('experts',
         ['subscribed' => $subscribed, 'experts' => $experts]
        );
    }

    public function withName(Request $request)
    {
        $name = $request->input('name');

        $subscribed = Auth::user()->subscriptions()->paginate(20);
        $subscribedIds = auth()->user()->subscriptions()->pluck('expert_id');

        $experts = User::where('class', '1')
            ->where('name' , $name)
            ->whereNotIn('id', $subscribedIds)
            ->paginate(5);

        return view('experts', ['subscribed' => $subscribed, 'experts' => $experts]);
    }
}
