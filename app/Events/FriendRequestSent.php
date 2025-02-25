<?php

namespace App\Events;
namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FriendRequestSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $sender;
    public User $receiver;

    public function __construct(User $sender, User $receiver)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('user.' . $this->receiver->id);
    }

    public function broadcastWith(): array
    {
        return [
            'type' => 'friend_request',
            'sender_id' => $this->sender->id,
            'sender_name' => $this->sender->name,
            'message' => "{$this->sender->name} sent you a friend request.",
        ];
    }
}
