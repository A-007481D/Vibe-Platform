{{-- resources/views/posts/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Posts Feed')

@section('content')
<div class="container mx-auto pt-20 px-4 pb-20">
    <h1 class="text-3xl font-bold mb-6">News Feed</h1>
    @if($posts->isEmpty())
    <p>No posts available.</p>
    @else
    @foreach($posts as $post)
    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
        <div class="p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ $post->user->profile_photo ? Storage::url($post->user->profile_photo) : '/default-avatar.png' }}" class="w-10 h-10 rounded-full" alt="{{ $post->user->username }}">
                    <div>
                        <div class="font-medium">{{ $post->user->username }}</div>
                        <div class="text-slate-500 text-sm">{{ $post->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @if($post->user_id === auth()->id())
                <div class="flex gap-2">
                    <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="mt-4">
                <p>{{ $post->content }}</p>
                @if ($post->image_url)
                <img src="{{ $post->image_url }}" alt="Post Image" class="mt-4 rounded">
                @endif
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <!-- Pagination -->
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
