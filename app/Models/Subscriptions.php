<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['subscriberId', 'traderId'];

    public function subscriptions (){
        
    }
}
