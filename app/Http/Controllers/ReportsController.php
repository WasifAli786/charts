<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Trades;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function create()
    {
        $query = Trades::where('user_id', Auth::id());

        $statistics = $query->get()
            ->reduce(function ($carry, $trade) {
                if ($trade->tradeHistory->isNotEmpty()) {
                    $history = $trade->tradeHistory;

                    foreach ($history as $entry) {
                        if ($trade->status == 'win') {
                            $carry->PnL += $entry->entry_exit * $entry->quantity;

                            $trade->side == 'long'
                                ? $carry->returnOnLong += $entry->entry_exit * $entry->quantity
                                : $carry->returnOnShort += $entry->entry_exit * $entry->quantity;

                            $entry->call == 'buy'
                                ? $carry->boughtShares += $entry->quantity
                                : $carry->soldShares += $entry->quantity;
                        } elseif ($trade->status == 'loss') {
                            $carry->PnL -= $entry->quantity * $entry->entry_exit;

                            $trade->side == 'long'
                                ? $carry->returnOnLong -=  $entry->entry_exit * $entry->quantity
                                : $carry->returnOnShort -= $entry->entry_exit * $entry->quantity;

                            $entry->call == 'buy'
                                ? $carry->boughtShares += $entry->quantity
                                : $carry->soldShares += $entry->quantity;
                        } else {
                            if ($entry->call == 'buy') {
                                $carry->totalShares += $entry->quantity;
                                $carry->openPosition -= $entry->quantity * $entry->entry_exit;
                            } else {
                                $carry->totalShares -= $entry->quantity;
                                $carry->openPosition += $entry->quantity * $entry->entry_exit;
                            }
                        }
                    }
                }

                if ($trade->status == 'win') {
                    $carry->wins++;

                    $win = 0;
                    foreach ($trade->tradeHistory as $entry) {
                        if ($entry->call == 'buy') {
                            $win -= $entry->entry_exit * $entry->quantity;
                            $carry->returnOnWins -= $entry->entry_exit * $entry->quantity;
                        } else {
                            $win += $entry->entry_exit * $entry->quantity;
                            $carry->returnOnWins += $entry->entry_exit * $entry->quantity;
                        }
                    }

                    if ($carry->biggestWin < $win) {
                        $carry->biggestWin = $win;
                    }
                } elseif ($trade->status == 'loss') {
                    $carry->losses++;

                    $loss = 0;
                    foreach ($trade->tradeHistory as $entry) {
                        if ($entry->call == 'buy') {
                            $loss -= $entry->entry_exit * $entry->quantity;
                            $carry->returnOnLosses += $entry->entry_exit * $entry->quantity;
                        } else {
                            $loss += $entry->entry_exit * $entry->quantity;
                            $carry->returnOnLosses -= $entry->entry_exit * $entry->quantity;
                        }
                    }

                    if ($carry->biggestLoss < $loss) {
                        $carry->biggestLoss = $loss;
                    }
                } else {
                    $carry->open++;
                }

                if ($trade->side === 'long') {
                    $carry->long++;
                } elseif ($trade->side === 'short') {
                    $carry->short++;
                }

                return $carry;
            }, (object) [
                'openPosition' => 0,
                'returnOnWins' => 0,
                'returnOnLosses' => 0,
                'returnOnLong' => 0,
                'returnOnShort' => 0,
                'biggestWin' => 0,
                'biggestLoss' => 0,
                'PnL' => 0,
                'wins' => 0,
                'losses' => 0,
                'long' => 0,
                'short' => 0,
                'open' => 0,
                'totalShares' => 0,
                'boughtShares' => 0,
                'soldShares' => 0,
            ]);

        return view('reports', ['statistics' => $statistics]);
    }
}
