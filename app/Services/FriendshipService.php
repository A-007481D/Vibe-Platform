<?php

namespace App\Services;

use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;

class FriendshipService
{
    public function getFriends()
    {
        return FriendRequest::where(function ($query) {
            $query->where('sender_id', Auth::user()->id)
                ->orWhere('receiver_id', Auth::user()->id);
        })->where('status', 'accepted')->get();
    }

    public function sendFriendRequest($userId)
    {
        //
    }

    public function acceptFriendRequest($requestId)
    {
        //
    }
}
