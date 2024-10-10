<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeHistory extends Model
{
    use HasFactory;

    protected $fillable = ['call', 'priceperunit', 'quantity', 'date', 'time', 'trades_id', 'stock_id'];

    public $timestamps = false;

    public function trades()
    {
        return $this->belongsTo(Trades::class, 'trades_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stocks::class, 'stock_id');
    }
}
