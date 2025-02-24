<?php

namespace App\Services;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendRequestService
{
    public function sendRequest(User $receiver)
    {
        $sender = Auth::user();

        // Ensure the sender is not trying to add themselves
        if ($sender->id === $receiver->id) {
            return false;
        }

        // Check if a friend request already exists
        $exists = FriendRequest::where(function ($query) use ($sender, $receiver) {
            $query->where('sender_id', $sender->id)
                ->where('receiver_id', $receiver->id);
        })->orWhere(function ($query) use ($sender, $receiver) {
            $query->where('sender_id', $receiver->id)
                ->where('receiver_id', $sender->id);
        })->exists();

        if ($exists) {
            return false; // Request already exists
        }

        // Create the friend request
        return FriendRequest::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'status' => 'pending',
        ]);
    }

    public function acceptRequest(FriendRequest $request)
    {
        $request->update(['status' => 'accepted']);
    }

    public function rejectRequest(FriendRequest $request)
    {
        $request->update(['status' => 'rejected']);
    }

    public function cancelRequest(FriendRequest $request)
    {
        $request->delete();
    }

    public function getPendingRequests()
    {
        return FriendRequest::where('receiver_id', Auth::id())
            ->where('status', 'pending')
            ->get();
    }
}
