<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|uuid',
            'content' => 'required|string',
        ]);

        Comment::create([
            'id' => (string) Str::uuid(),
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully!');
    }
}
