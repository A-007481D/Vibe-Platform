<?php

namespace App\Services;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendRequestService
{
    public function sendRequest(User $receiver)
    {
        $sender = Auth::user();

        // the sender cannot add themself
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

        return FriendRequest::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'status' => 'pending',
        ]);
    }

    public function acceptRequest(FriendRequest $request)
    {
        $request->update(['status' => 'accepted']);

        $user1 = $request->sender_id;
        $user2 = $request->receiver_id;

        if ($user1 > $user2) {
            [$user1, $user2] = [$user2, $user1]; // Swap to maintain order
        }

        if (!DB::table('friends')->where('user_id', $user1)->where('friend_id', $user2)->exists()) {
            DB::table('friends')->insert([
                'user_id' => $user1,
                'friend_id' => $user2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
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
