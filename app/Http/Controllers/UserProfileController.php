<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        $user->loadCount(['posts', 'likes', 'comments', 'shares', 'friends']);

        return view('profile.show', [
            'profileUser' => $user,
            'posts' => $user->posts()
                ->withCount(['likes', 'comments'])
                ->latest()
                ->paginate(10),

            'likes' => $user->likes()
                ->with(['post.user', 'post.likes', 'post.comments'])
                ->latest()
                ->paginate(10),

            'comments' => $user->comments()
                ->with(['post.user', 'post.likes', 'post.comments'])
                ->latest()
                ->paginate(10),

            'shares' => $user->shares()
                ->with(['post.user', 'post.likes', 'post.comments'])
                ->latest()
                ->paginate(10)
        ]);
    }
}
