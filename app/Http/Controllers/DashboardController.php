<?php

namespace App\Http\Controllers;

use App\Models\Trades;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function create($range = null)
    {
        $statistics = $this->statictics($range);

        $openTrades = Trades::where('user_id', Auth::id())->where('status', 'open')->get();

        $openPosition = 0;

        foreach ($openTrades as $trade) {
            $history = $trade->tradeHistory;
            $statistics->open++;

            if ($history) {
                foreach ($history as $entry) {
                    $quantity = $entry->quantity;
                    $priceperunit = $entry->priceperunit;

                    if ($entry->call == 'buy') {
                        $openPosition += $quantity * $priceperunit;
                    } else {
                        $openPosition -= $quantity * $priceperunit;
                    }
                }
            }
        }

        return view('dashboard', [
            'experts' => Auth::user()->subscriptions,
            'openPosition' => $openPosition,
            'statistics' => $statistics,
            'totalInvestment' => Auth::user()->total_investment
        ]);
    }

    private function generateDateRange($range)
    {
        switch ($range) {
            case 'today':
                return [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()];
            case 'yesterday':
                return [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()];
            case 'thisweek':
                return [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
            case 'lastweek':
                return [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()];
            case 'thismonth':
                return [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
            case 'lastmonth':
                return [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()];
            case 'last3months':
                return [Carbon::now()->subMonths(3)->startOfMonth(), Carbon::now()->endOfMonth()];
            default:
                return null;
        }
    }

    public function statictics($range = null)
    {
        $dateRange = $this->generateDateRange($range);

        $query = Trades::where('user_id', Auth::id())->where('status', '!=', 'open');

        if ($dateRange) {
            $query->whereBetween('date', $dateRange);
        }

        $statistics = $query->get()
            ->reduce(
                function ($carry, $trade) {
                    if ($trade->tradeHistory->count() != 0) {
                        $history = $trade->tradeHistory;
                        foreach ($history as $entry) {
                            if ($entry->call = 'sell') {
                                $carry->pnl += $entry->priceperunit * $entry->quantity;
                                $carry->long++;
                            } else {
                                $carry->pnl -= $entry->priceperunit * $entry->quantity;
                                $carry->short++;
                            }
                        }
                    }

                    if ($trade->status == 'win') {
                        $carry->wins++;
                    } elseif ($trade->status == 'loss') {
                        $carry->losses++;
                    }

                    $carry->closed++;

                    return $carry;
                },
                (object)
                [
                    'pnl' => 0,
                    'wins' => 0,
                    'losses' => 0,
                    'long' => 0,
                    'short' => 0,
                    'open' => 0,
                    'closed' => 0
                ]
            );

        return $statistics;
    }
}
