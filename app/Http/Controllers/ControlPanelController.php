<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ControlPanelController extends Controller
{
    public function show(string $class = null)
    {
        $users = User::where('id', '!=', Auth::id())->paginate(50);

        return view('controlPanel', ['users' => $users]);
    }

    public function subscribers(string $class = null)
    {
        $users = User::whereHas('subscriptions')->where('id', '!=', Auth::id())->paginate(50);

        return view('controlPanel', ['users' => $users]);
    }

    public function nonSubscribers(string $class = null)
    {
        $users = User::whereDoesntHave('subscriptions',)->where('id', '!=', Auth::id())->paginate(50);

        return view('controlPanel', ['users' => $users]);
    }

    public function experts(string $class = null)
    {
        $users = User::where('class', 1)->paginate(50);

        return view('controlPanel', ['users' => $users]);
    }

    public function getTraders(string $email)
    {
        $users = User::where('email', 'LIKE', $email . '%')->get();

        return response()->json($users);
    }

    public function getTraderSubscriptions(int $id)
    {
        $subscriptions = User::find($id)->subscriptions->count();

        return response()->json($subscriptions);
    }

    public function updateStatus(int $id, int $status)
    {
        $user = User::find($id);

        $user->update([
            'status' => $status
        ]);
    }

    public function updateClass(int $id, int $class)
    {
        $user = User::find($id);

        $user->update([
            'class' => $class
        ]);
    }

    public function register()
    {
        $requests = Subscriptions::where('status', 'pending')->paginate(50);

        return view('registersubscriptions', ['requests' => $requests]);
    }

    public function allow(int $id)
    {
        $sub = Subscriptions::find($id)->update(['status' => 'paid' , 'subscribed_at' => Carbon::now()]);

        return redirect('/controlpanel/registersubscription');
    }

    public function decline(int $id)
    {
        Subscriptions::destroy($id);

        return redirect('/controlpanel/registersubscription');
    }
}
