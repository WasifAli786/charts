<?php

namespace App\Jobs;

use App\Models\User as ModelsUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\ExpertNotification;

class ExpertNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user_id;
    private $notificationText;

    public function __construct($user_id, $notificationText)
    {
        $this->user_id = $user_id;
        $this->notificationText = $notificationText;
    }

    public function handle()
    {
        $user = ModelsUser::find($this->user_id);
        if ($user) {
            $user->notify(new ExpertNotification($this->notificationText));
        }
    }
}
