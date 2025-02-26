@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto pt-20 px-4 pb-20">
        <!-- Create Post Section -->
        <div class="bg-white rounded-xl shadow-sm mb-6 p-4">
            <div class="flex gap-3">
                <img src="{{ auth()->user()->profile_photo ? Storage::url(auth()->user()->profile_photo) : '/default-avatar.png' }}" class="w-10 h-10 rounded-full" alt="Your Profile">
                <div class="flex-1">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <textarea name="content" class="w-full bg-slate-50 rounded-lg px-4 py-2 focus:outline-none resize-none" rows="2" placeholder="What's on your mind?"></textarea>
                        <div class="flex justify-between mt-3 items-center">
                            <div class="flex gap-2">
                                <!-- Button for adding images -->
                                <label for="postImage" class="cursor-pointer p-2 hover:bg-slate-100 rounded-full text-violet-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <input id="postImage" type="file" name="image" class="hidden">
                                </label>
                            </div>
                            <button type="submit" class="bg-violet-500 text-white px-5 py-1.5 rounded-full hover:bg-violet-600 font-medium">Share</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Posts Feed -->
        <div class="space-y-6">
            @foreach($posts as $post)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
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
                            @if($post->image_url)
                                <img src="{{ $post->image_url }}" alt="Post Image" class="mt-4 rounded">
                            @endif
                        </div>
                    </div>
                    <!-- Post Interactions -->
                    <div class="px-4 py-3 bg-slate-50 flex items-center gap-6">
                        <!-- Example interaction buttons (likes, comments, share) -->
                        <button class="flex items-center gap-2 text-slate-600 hover:text-violet-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span>{{ $post->likes()->count() }}</span>
                        </button>
                        <button onclick="toggleComments('comments-{{ $post->id }}')" class="flex items-center gap-2 text-slate-600 hover:text-violet-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>{{ $post->comments()->count() }}</span>
                        </button>
                        <button class="flex items-center gap-2 text-slate-600 hover:text-violet-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                            <span>Share</span>
                        </button>
                    </div>
                    <!-- Comments Section -->
                    <div id="comments-{{ $post->id }}" class="hidden p-4 bg-slate-50 border-t">
                        @foreach($post->comments as $comment)
                            <div class="flex gap-3 mb-3">
                                <img src="{{ $comment->user->profile_photo ? Storage::url($comment->user->profile_photo) : '/default-avatar.png' }}" class="w-8 h-8 rounded-full" alt="Commenter">
                                <div>
                                    <div class="font-medium">{{ $comment->user->username }}</div>
                                    <p class="text-slate-600 text-sm">{{ $comment->content }}</p>
                                    <div class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Add Comment Form -->
                        <form action="{{ route('comments.store') }}" method="POST" class="flex gap-3 mt-4">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <img src="{{ auth()->user()->profile_photo ? Storage::url(auth()->user()->profile_photo) : '/default-avatar.png' }}" class="w-8 h-8 rounded-full" alt="Your avatar">
                            <input type="text" name="content" class="w-full bg-white rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400" placeholder="Write a comment...">
                            <button type="submit" class="px-4 py-2 bg-violet-500 text-white rounded-full hover:bg-violet-600">Post</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- JavaScript for toggling comments -->
    <script>
        function toggleComments(id) {
            const comments = document.getElementById(id);
            comments.classList.toggle('hidden');
        }
    </script>
@endsection
