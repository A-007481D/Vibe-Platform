<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use App\Services\FriendRequestService;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    protected FriendRequestService $friendRequestService;

    public function __construct(FriendRequestService $friendRequestService)
    {
        $this->friendRequestService = $friendRequestService;
    }

    public function sendRequest($receiverId)
    {
        $receiver = User::findOrFail($receiverId);

        if ($this->friendRequestService->sendRequest($receiver)) {
            return redirect()->back()->with('success', 'Friend request sent!');
        }

        return redirect()->back()->with('error', 'Friend request could not be sent.');
    }

    public function acceptRequest(FriendRequest $request)
    {
        if (!\Ramsey\Uuid\Uuid::isValid($request->id)) {
            abort(400, "Invalid request ID");
        }

        $this->friendRequestService->acceptRequest($request);

        return redirect()->back()->with('success', 'Friend request accepted!');
    }

    public function rejectRequest(FriendRequest $request)
    {
        $this->friendRequestService->rejectRequest($request);
        return redirect()->back()->with('success', 'Friend request rejected.');
    }

    public function cancelRequest(FriendRequest $request)
    {
        $this->friendRequestService->cancelRequest($request);
        return redirect()->back()->with('success', 'Friend request canceled.');
    }

    public function showRequests()
    {
        $requests = $this->friendRequestService->getPendingRequests();
        return view('friend-requests', compact('requests'));
    }
}
