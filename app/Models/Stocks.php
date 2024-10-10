<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'symbol', 'current_value'];

    public function trades()
    {
        return $this->hasMany(Trades::class, 'stock_id');
    }

    public function tradeHistories()
    {
        return $this->hasMany(TradeHistory::class, 'stock_id');
    }
}
