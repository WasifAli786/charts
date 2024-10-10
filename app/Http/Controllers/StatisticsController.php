<?php

namespace App\Http\Controllers;

use App\Models\Trades;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
  public function statictics($range = null)
  {
    $dateRange = $this->generateDateRange($range);

    $query = Trades::where('user_id', Auth::id())->where('status', '!=', 'open');

    if ($dateRange) {
      $query->whereBetween('date', $dateRange);
    }

    $statistics = $query->get()
      ->reduce(function ($carry, $trade) {
        if ($trade->tradeHistory->isNotEmpty()) {
          $history = $trade->tradeHistory;

          foreach ($history as $entry) {
            $entry->call === 'sell'
              ? $carry->pnl += $entry->priceperunit * $entry->quantity
              : $carry->pnl -= $entry->priceperunit * $entry->quantity;
          }
        }

        if ($trade->status == 'win') {
          $carry->wins++;
        } elseif ($trade->status == 'loss') {
          $carry->losses++;
        }

        if ($trade->side === 'long') {
          $carry->long++;
        } elseif ($trade->side === 'short') {
          $carry->short++;
        }

        $carry->closed++;

        return $carry;
      }, (object) [
        'pnl' => 0,
        'wins' => 0,
        'losses' => 0,
        'long' => 0,
        'short' => 0,
        'open' => 0,
        'closed' => 0
      ]);

    return $statistics;
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
}
