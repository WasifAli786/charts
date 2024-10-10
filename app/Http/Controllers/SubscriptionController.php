<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use App\Models\User;
use App\Notifications\NewSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SubscriptionController extends Controller
{
    public function subscribe(int $id)
    {
        $subscription = Subscriptions::where('user_id', Auth::id())->where('trader_id', $id)->first();

        if (!$subscription) {
            Subscriptions::create([
                'user_id' => Auth::id(),
                'trader_id' => $id,
                'subscribed_at' => Carbon::now()
            ]);
            Auth::user()->notify(new NewSubscription($id));
        }

        return view('subscribed');
    }

    public function unsubscribe(int $id)
    {
        Subscriptions::where('user_id', Auth::id())
            ->where('trader_id', $id)
            ->destroy();
    }
}
