<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    protected $follower;
    protected $followee;
    public function __construct(User $follower, User $followee)
    {
        $this->follower = $follower;
        $this->followee = $followee;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'follower_id'=>$this->follower->id,
            'followee_id'=>$this->followee->id,
            'message'=>$this->follower->name . ' Followed You ',
        ]);
    }

}
