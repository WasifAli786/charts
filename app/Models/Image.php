<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['image_path', 'trade_id'];

    public function trade()
    {
        return $this->belongsTo(Trades::class);
    }
}
