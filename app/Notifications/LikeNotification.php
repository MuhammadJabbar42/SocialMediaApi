<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $liker;
    public $post;
    public function __construct(User $liker, Post $post)
    {
        $this->liker = $liker;
        $this->post = $post;
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
            'Liker_ID'=>$this->liker->id,
            'Post_ID'=>$this->post->id,
            'message' => $this->liker->name . ' liked your post.',

        ]);

    }
    public function broadcastType()
    {
        return 'like.notification';
    }
}
