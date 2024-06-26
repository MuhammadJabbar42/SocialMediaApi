<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationCount implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    protected $count;
    protected $userId;
    public function __construct($count,$userId)
    {
        $this->count = $count;
        $this->userId = $userId;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [

            new PrivateChannel('user.notification.'.$this->userId)
        ];
    }
    public function broadcastWith()
    {
        return [
            'count'=>$this->count,
        ];
    }
}
