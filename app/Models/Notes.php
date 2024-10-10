<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;

    protected $fillable = ['heading', 'content', 'trades_id', 'type'];

    public $timestamps = false;

    public function trades()
    {
        return $this->belongsTo(Trades::class);
    }
}
