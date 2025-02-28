@extends('layouts.app')
@section('title', $profileUser->username . "'s Profile")
@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 relative">
                <!-- Profile Picture -->
                <div class="absolute -bottom-16 left-6">
                    <div class="h-32 w-32 rounded-full border-4 border-white overflow-hidden">
                        <img src="{{ $profileUser->profile_photo_url }}"
                             class="w-full h-full object-cover"
                             alt="{{ $profileUser->username }}'s profile photo">
                    </div>
                </div>
            </div>

            <!-- Profile Info -->
            <div class="pt-20 pb-6 px-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ $profileUser->first_name }} {{ $profileUser->last_name }}
                        </h1>
                        <p class="text-gray-600">@{{ $profileUser->username }}</p>
                        @if($profileUser->bio)
                            <p class="mt-2 text-gray-700">{{ $profileUser->bio }}</p>
                        @endif
                    </div>

                    @auth
                        <div class="mt-4 md:mt-0 flex items-center space-x-3">
                            @if(auth()->user()->isFriend($profileUser))
                                <form method="POST" action="{{ route('friend.unfriend', $profileUser) }}">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                        Unfriend
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('friend-request.send', $profileUser) }}">
                                    @csrf
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                        Add Friend
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endauth
                </div>

                <!-- Stats -->
                <div class="mt-6 flex border-t border-gray-200 pt-6">
                    <div class="w-1/4 text-center">
                        <span class="text-xl font-bold">{{ $profileUser->posts_count }}</span>
                        <p class="text-gray-600 text-sm">Posts</p>
                    </div>
                    <div class="w-1/4 text-center border-x border-gray-200">
                        <span class="text-xl font-bold">{{ $profileUser->likes_count }}</span>
                        <p class="text-gray-600 text-sm">Likes</p>
                    </div>
                    <div class="w-1/4 text-center border-r border-gray-200">
                        <span class="text-xl font-bold">{{ $profileUser->comments_count }}</span>
                        <p class="text-gray-600 text-sm">Comments</p>
                    </div>
                    <div class="w-1/4 text-center">
                        <span class="text-xl font-bold">{{ $profileUser->shares_count }}</span>
                        <p class="text-gray-600 text-sm">Shares</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div x-data="{ activeTab: 'posts' }" class="mb-6">
            <div class="flex border-b border-gray-200">
                <button @click="activeTab = 'posts'"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': activeTab === 'posts' }"
                        class="px-6 py-3 font-medium text-gray-600 hover:text-gray-900">
                    Posts ({{ $profileUser->posts_count }})
                </button>
                <button @click="activeTab = 'likes'"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': activeTab === 'likes' }"
                        class="px-6 py-3 font-medium text-gray-600 hover:text-gray-900">
                    Likes ({{ $profileUser->likes_count }})
                </button>
                <button @click="activeTab = 'comments'"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': activeTab === 'comments' }"
                        class="px-6 py-3 font-medium text-gray-600 hover:text-gray-900">
                    Comments ({{ $profileUser->comments_count }})
                </button>
                <button @click="activeTab = 'shares'"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': activeTab === 'shares' }"
                        class="px-6 py-3 font-medium text-gray-600 hover:text-gray-900">
                    Shares ({{ $profileUser->shares_count }})
                </button>
            </div>

            <!-- Tab Content -->
            <div class="mt-4">
                <!-- Posts Tab -->
                <div x-show="activeTab === 'posts'" class="space-y-4">
                    @forelse($posts as $post)
                        @include('posts.partials.card', ['post' => $post])
                    @empty
                        <div class="bg-white p-4 rounded-lg shadow text-center text-gray-500">
                            No posts found
                        </div>
                    @endforelse
                    {{ $posts->links() }}
                </div>

                <!-- Likes Tab -->
                <div x-show="activeTab === 'likes'" class="space-y-4">
                    @forelse($likes as $like)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="text-sm text-gray-500 mb-2">
                                Liked {{ $like->created_at->diffForHumans() }}
                            </div>
                            @include('posts.partials.card', ['post' => $like->post])
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded-lg shadow text-center text-gray-500">
                            No likes found
                        </div>
                    @endforelse
                    {{ $likes->links() }}
                </div>

                <!-- Comments Tab -->
                <div x-show="activeTab === 'comments'" class="space-y-4">
                    @forelse($comments as $comment)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="text-sm text-gray-500 mb-2">
                                Commented {{ $comment->created_at->diffForHumans() }}
                            </div>
                            <div class="pl-4 border-l-4 border-blue-500 bg-blue-50 rounded">
                                {{ $comment->content }}
                            </div>
                            <div class="mt-4">
                                @include('posts.partials.card', ['post' => $comment->post])
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded-lg shadow text-center text-gray-500">
                            No comments found
                        </div>
                    @endforelse
                    {{ $comments->links() }}
                </div>

                <!-- Shares Tab -->
                <div x-show="activeTab === 'shares'" class="space-y-4">
                    @forelse($shares as $share)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="text-sm text-gray-500 mb-2">
                                Shared {{ $share->created_at->diffForHumans() }}
                            </div>
                            @include('posts.partials.card', ['post' => $share->post])
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded-lg shadow text-center text-gray-500">
                            No shares found
                        </div>
                    @endforelse
                    {{ $shares->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
