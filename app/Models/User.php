<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = ['name', 'email', 'password', 'profile_image', 'total_investment'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['password' => 'hashed',];

    public function trades()
    {
        return $this->hasMany(Trades::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'subscriber_id', 'expert_id');
    }

    public static function statistics(int $user_id)
    {
        $statistics = [
            'alltime' => self::calculatePnL($user_id, Carbon::parse('1970-01-01'), Carbon::now()),
            'thismonth' => self::calculatePnL($user_id, Carbon::now()->startOfMonth(), Carbon::now()),
            'lastmonth' => self::calculatePnL($user_id, Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()),
            'last6months' => self::calculatePnL($user_id, Carbon::now()->submonth(6)->startOfMonth(), Carbon::now()),
        ];

        return (object) $statistics;
    }

    private static function calculatePnL(int $user_id, Carbon $startDate, Carbon $endDate)
    {
        return Trades::where('user_id', $user_id)
            ->where('status', '!=', 'open')
            ->whereHas('tradeHistory', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->get()
            ->reduce(function ($carry, $trade) {
                if ($trade->tradeHistory->isNotEmpty()) {
                    $history = $trade->tradeHistory;

                    foreach ($history as $entry) {
                        $entry->call === 'buy'
                            ? $carry->PnL -= $entry->priceperunit * $entry->quantity
                            : $carry->PnL += $entry->quantity * $entry->priceperunit;
                    }
                }

                return $carry;
            }, (object) ['PnL' => 0]);
    }
}
