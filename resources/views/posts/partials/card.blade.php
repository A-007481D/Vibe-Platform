<div class="bg-white rounded-lg shadow-md p-6 mb-4">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
            <img src="{{ $post->user->profile_photo_url }}"
                 class="w-10 h-10 rounded-full mr-3"
                 alt="{{ $post->user->username }}'s profile photo">
            <div>
                <p class="font-medium">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <p class="text-gray-800 mb-4">{{ $post->content }}</p>

    @if($post->image_url)
        <img src="{{ $post->image_url }}"
             alt="Post image"
             class="rounded-lg mb-4 w-full max-h-96 object-cover">
    @endif

    <div class="flex items-center justify-between text-sm text-gray-600">
        <div class="flex space-x-4">
            <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{ $post->likes_count }}
            </span>
            <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                {{ $post->comments_count }}
            </span>
        </div>
    </div>
</div>
