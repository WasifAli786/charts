<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\User;

class PersentageCalculator
{
  public static function calculatePortfolio($trader, $accumulated)
  {
    $portfolio = User::find($trader)->totalInvestment;
    
    if ($accumulated != 0 && $portfolio != 0) {
      return round(($accumulated / $portfolio) * 100, 2);
    } else {
      return 0;
    }
  }
}
