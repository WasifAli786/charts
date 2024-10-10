<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trades extends Model
{
    use HasFactory;

    protected $fillable = ['symbol', 'status', 'date', 'time', 'user_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tradeHistory()
    {
        return $this->hasMany(TradeHistory::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function notes()
    {
        return $this->hasMany(Notes::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stocks::class, 'stock_id');
    }
}
