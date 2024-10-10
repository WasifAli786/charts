<?php

namespace App\Http\Controllers;

use App\Helpers\PersentageCalculator;
use App\Models\TradeHistory;
use App\Models\Trades;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TradesController extends Controller
{
    public function create()
    {
        return view('addtrades');
    }

    public function store(Request $request)
    {
        $request->validate([
            'symbol' => 'required',
            'priceperunit' => 'required|numeric|not_in:0.00',
            'quantity' => 'required|numeric|not_in:0.00',
            'call' => ['required', Rule::in(['buy', 'sell']),],
        ]);

        $amount = ($request->entry * $request->quantity);

        // $amountValidator = Validator::make(
        // ['amount' => $amount],
        // ['amount' => [new App\Http\Controllers\CheckInvestment($amount)]]
        // );

        // if ($amountValidator->fails()) {
        //     return redirect()->back()->withErrors(['amount' => 'Insufficient investment. Please update your profile.']);
        // }

        $trade = Trades::create([
            'symbol' => $request->symbol,
            'status' => 'open',
            'date' => $request->date ? Carbon::createFromFormat('d/m/Y', $request->date)->format('Y/m/d') : Carbon::now(),
            'time' => $request->time ?? Carbon::now(),
            'user_id' => Auth::id()
        ]);

        TradeHistory::create([
            'call' => $request->call,
            'priceperunit' => $request->priceperunit,
            'quantity' => $request->quantity,
            'date' => $request->date ? Carbon::createFromFormat('d/m/Y', $request->date)->format('Y/m/d') : Carbon::now(),
            'time' => $request->time ?? Carbon::now(),
            'trades_id' => $trade->id
        ]);

        // $subscriptions = Auth::user()->subscriptions;

        // foreach ($subscriptions as $subscription) {
        //     $subscription->notify(
        //         new ExpertNotification(
        //             ucfirst(Auth::user()->name)
        //                 . ' just opened a new trade '
        //                 . strtoupper($trade->symbol)
        //                 . ' and bought '
        //                 . $request->quantity
        //                 . ' shares.',
        //             $subscription->id,
        //             $trade->id
        //         )
        //     );
        // }

        return redirect()->action([TradesController::class, 'show'], ['trader' => Auth::id(), 'id' => $trade->id]);
    }

    public function show(int $trader, int $id)
    {
        $trade = Trades::find($id);

        if ($trade) {
            $images = $trade->images()->get();
            $setups = $trade->notes()->where('type', 'setup')->get();
            $mistakes = $trade->notes()->where('type', 'mistake')->get();

            $history = $trade->tradeHistory()->orderBy('date', 'desc')->get();

            if ($history->isempty()) {
                $portfolioPersentage = 0;
            } else {
                $portfolioPersentage = PersentageCalculator::calculatePortfolio(
                    $trader,
                    $history[0]->priceperunit * $history[0]->quantity
                );

                $history = TradeHistory::orderBy('date', 'asc')->get();
                $oldestHistory = $history->first();
                $latestHistory = $history->last();
            }

            return view('trade', [
                'trader' => $trader,
                'trade' => $trade,
                'history' => $history,
                'portfolioPersentage' => $portfolioPersentage,
                'oldestHistory' => $oldestHistory,
                'latestHistory' => $latestHistory,
                'images' => $images,
                'setups' => $setups,
                'mistakes' => $mistakes
            ]);
        } else {
            return redirect('/trades/' . Auth::id());
        }
    }

    public function edit(string $id)
    {
        $trade = Trades::where('id', $id)->first();

        if ($trade) {
            $latestTradeHistory = $trade->tradeHistory()->first();

            if ($latestTradeHistory) {
                $tradeAttributes = $trade->getAttributes();
                $latestTradeHistoryAttributes = $latestTradeHistory->getAttributes();

                unset($latestTradeHistoryAttributes['id']);

                $trade = array_merge($tradeAttributes, $latestTradeHistoryAttributes);
            }
        }

        return view('editTrade', ['trade' => $trade]);
    }

    public function update(Request $request, string $id)
    {
        $trade = Trades::where('id', $id)->first();
        $status = 'open';

        
        if (!$trade) {
            return response()->json(['error' => 'Trade not found'], 404);
        }
        
        $trade->update([
            'status' => $request->status,
        ]);
        
        return response()->json(['success' => 'Status updated'], 200);
    }

    public function trades(int $id)
    {
        $trades = TradeHistory::whereHas('trades', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->paginate(50);

        return view('trades', [
            'trades' => $trades,
            'id' => $id
        ]);
    }

    public function searchSymbol(int $id, string $symbol)
    {
        if ($id != Auth::id()) {
            if (Auth::user()->subscriptions->where('id', $id)->count() <= 0) {
                redirect('/trades' . Auth::id());
            }
        }

        $closedTrades = Trades::where('user_id', $id)
            ->where('symbol', $symbol)
            ->where('status', '!=', 'open')
            ->orderBy('date', 'desc')
            ->paginate(20);

        $openTrades = TradeHistory::whereHas('trade', function ($trade) use ($symbol, $id) {
            $trade->where('user_id', $id)->where('symbol', $symbol)->where('status', 'open');
        })->orderBy('date', 'desc')->paginate(20);

        return view('trades', ['openTrades' => $openTrades, 'closedTrades' => $closedTrades, 'id' => $id]);
    }


    public function getTrades($id, $range)
    {
        if ($id != Auth::id()) {
            if (Auth::user()->subscriptions->where('id', $id)->count() <= 0) {
                redirect('/trades' . Auth::id());
            }
        }
        switch ($range) {
            case 'today':
                $dateRange = [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()];
                break;
            case 'yesterday':
                $dateRange = [Carbon::yesterday()->startOfDay(), Carbon::yesterday()->endOfDay()];
                break;
            case 'thisweek':
                $dateRange = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
                break;
            case 'lastweek':
                $dateRange = [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()];
                break;
            case 'thismonth':
                $dateRange = [Carbon::now()->startOfMonth(), Carbon::now()->subWeek()->endOfWeek()];
                break;
            default:
                $dateRange = [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()];
                break;
        }

        $closedTrades = Trades::where('user_id', auth()->id())
            ->whereBetween('date', $dateRange)
            ->where('status', '!=', 'open')
            ->orderBy('date', 'desc')
            ->paginate(20);

        $openTrades = TradeHistory::whereHas('trade', function ($trade) use ($dateRange) {
            $trade->where('user_id', auth()->id())
                ->whereBetween('date', $dateRange)
                ->where('status', 'open');
        })
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('trades', ['openTrades' => $openTrades, 'closedTrades' => $closedTrades, 'id' => $id]);
    }

    public function range(Request $request, int $id)
    {
        if ($id != Auth::id()) {
            if (Auth::user()->subscriptions->where('id', $id)->count() <= 0) {
                redirect('/trades' . Auth::id());
            }
        }

        $dateRange = $request->input('range');
        list($from, $to) = explode(' to ', $dateRange);
        $from = Carbon::createFromFormat('d/m/Y', trim($from));
        $to = Carbon::createFromFormat('d/m/Y', trim($to));

        $dateRange = [$from, $to];

        $closedTrades = Trades::where('user_id', $id)->whereBetween('date', $dateRange)
            ->where('status', '!=', 'open')
            ->orderBy('date', 'desc')
            ->paginate(20)
            ->withPath('/trades/range/?range=' . $request->input('range'));

        $openTrades = TradeHistory::whereHas('trade', function ($trade) use ($dateRange, $id) {
            $trade->where('user_id', $id)->whereBetween('date', $dateRange)->where('status', 'open');
        })->orderBy('date', 'desc')->paginate(20)->withPath(`/trades/$id/range/?range=` . $request->input('range'));

        return view('trades', ['openTrades' => $openTrades, 'closedTrades' => $closedTrades, 'id' => $id]);
    }

    public function destroy(string $id)
    {
        Trades::destroy($id);

        return redirect('/trades' . Auth::id());
    }
}
