<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use App\Services\FriendshipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{

    protected FriendshipService $friendshipService;
    public function __construct(FriendshipService $friendshipService){
        $this->friendshipService = $friendshipService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
     {
         $friends = $this->friendshipService->getFriends();

         return view('friends', compact('friends'));
     }

    public function unfriend(User $user)
    {

        $authUser = auth()->user();

        $authUser->friends()->detach($user->id);
        $user->friends()->detach($authUser->id);

        return response()->json(['success' => true, 'message' => 'Friend removed successfully!', 'friend_id' => $user->id]);

//        $authUser = auth()->user();
//
//        // Ensure we delete the correct friendship row
//        $user1 = $authUser->id;
//        $user2 = $user->id;
//
//        if ($user1 > $user2) {
//            [$user1, $user2] = [$user2, $user1]; // Ensure ordering matches insertion logic
//        }
//
//        DB::table('friends')
//            ->where('user_id', $user1)
//            ->where('friend_id', $user2)
//            ->delete();
//
//        return redirect()->back()->with('success', 'Friend removed successfully!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FriendRequest $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FriendRequest $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FriendRequest $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FriendRequest $friend)
    {
        //
    }
}
