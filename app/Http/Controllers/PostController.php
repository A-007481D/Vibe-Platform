<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'comments', 'likes', 'shares')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only('content');
        $data['id'] = (string) Str::uuid();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image_url'] = Storage::url($path);
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only('content');

        if ($request->hasFile('image')) {
            if ($post->image_url) {
                Storage::delete(str_replace('/storage/', '', $post->image_url));
            }
            $path = $request->file('image')->store('posts', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        // Optionally, delete image file if exists
        if ($post->image_url) {
            Storage::delete(str_replace('/storage/', '', $post->image_url));
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
