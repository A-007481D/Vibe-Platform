<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
     {
    //     $friends1 = Friend::where('sender_id', Auth::user()->id)
    //         ->orWhere('reciever_id', Auth::user()->id)->where('status','accepted')->get();

        $friends = Friend::where(function ($query) {
            $query->where('sender_id', Auth::user()->id)
                        ->orWhere('reciever_id', Auth::user()->id);
        })->where('status','accepted');

        $search = $request->search;


        if ($request->search) {
            
            $friends = $friends->whereHas('reciever', function($q) use($search) {
                $q->where('id' , '!=', Auth::user()->id);
                $q->where('name', 'like', '%'.$search.'%');

            })->orWhereHas('sender', function($q) use($search) {
                $q->where('id' , '!=', Auth::user()->id);
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
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Friend $friend)
    {
        //
    }
}
