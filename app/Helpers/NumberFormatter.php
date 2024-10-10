<?php

declare(strict_types=1);

namespace App\Helpers;

class NumberFormatter
{
  public static function formatPakistanNumber($number)
  {
    if (substr($number, 0, 1) === '+') {
      $number = substr($number, 1);
    }
    
    $number = preg_replace('/^92/', '0', $number);

    return $number;
  }
}
