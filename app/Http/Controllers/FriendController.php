<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
     {
    //     $friends1 = FriendRequest::where('sender_id', Auth::user()->id)
    //         ->orWhere('reciever_id', Auth::user()->id)->where('status','accepted')->get();

        $friends = FriendRequest::where(function ($query) {
            $query->where('sender_id', Auth::user()->id)
                        ->orWhere('receiver_id', Auth::user()->id);
        })->where('status','accepted');

        $search = $request->search;


        if ($request->search) {

            $friends = $friends->whereHas('receiver', function($q) use($search) {
                $q->where('uuid' , '!=', Auth::user()->id);
                $q->where('name', 'like', '%'.$search.'%');

            })->orWhereHas('sender', function($q) use($search) {
                $q->where('uuid' , '!=', Auth::user()->id);
                $q->where('name', 'like', '%'.$search.'%');

            });

        }

        $friends = $friends->get();
        // dd($friends);

        return view('friends', compact('friends', 'search'));



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
