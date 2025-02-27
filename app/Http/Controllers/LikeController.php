<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request, Post $post)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $like = $post->likes()->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();
        } else {
            $post->likes()->create(['user_id' => $user->id]);
        }

        $post->load('likes');

        return view('components.like-button', ['post' => $post]);
    }
}
