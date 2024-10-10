<?php

namespace App\Http\Controllers;

use App\Models\TradeHistory;
use App\Models\Trades;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeHistoryController extends Controller
{
    public function store(Request $request, int $tradeId)
    {
        $trade = Trades::where('id', $tradeId)->where('user_id', Auth::id());

        if (!$trade->exists()) {
            return redirect()->back()->withErrors(['tradeOwnershipError' => 'This trade does not belongs to you.']);
        }

        $request->validate([
            'call' => 'required',
            'priceperunit' => 'required',
            'quantity'  => 'required',
        ], [
            'priceperunit.required' => 'The price field is required'
        ]);

        $history = TradeHistory::create([
            'call' => $request->call,
            'priceperunit' => $request->priceperunit,
            'quantity' => $request->quantity,
            'date' => $request->date ? Carbon::createFromFormat('d/m/Y', $request->date)->format('Y/m/d') : Carbon::now(),
            'time' => $request->time ?? now(),
            'trades_id' => $tradeId,
            'stock_id' => '44'
            // 'stock_id' => $trade->first()->stock->symbol
        ]);

        // $subscriptions = Auth::user()->subscriptions;

        // foreach ($subscriptions as $subscription) {
        //     $subscription->notify(
        //         new ExpertNotification(
        //             ucfirst(Auth::user()->name)
        //                 . ' just bought  '
        //                 . $request->quantity . ' shares of '
        //                 . strtoupper($history->trade->symbol),
        //             $subscription->id,
        //             $history->trade->id
        //         )
        //     );
        // }

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        TradeHistory::destroy($id);

        return json_encode($id);
    }
}
