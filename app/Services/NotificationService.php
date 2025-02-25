<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public function getUnreadNotifications()
    {
        return Notification::where('user_id', Auth::id())
            ->where('seen', false)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function createNotification($receiverId, $senderId, $type, $data)
    {
        return Notification::create([
            'user_id' => $receiverId,
            'sender_id' => $senderId,
            'type' => $type,
            'data' => $data,
            'seen' => false,
        ]);
    }
}
