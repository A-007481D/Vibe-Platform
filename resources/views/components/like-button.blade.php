<button
    class="like-btn flex items-center gap-2 text-slate-600 hover:text-violet-500"
    hx-post="{{ route('like.toggle', $post->id) }}"
    hx-swap="outerHTML"
    hx-target="this"
    hx-trigger="click"
    hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
>
    <svg class="w-5 h-5 like-icon {{ $post->likes->contains('user_id', auth()->id()) ? 'text-red-500' : '' }}"
         fill="{{ $post->likes->contains('user_id', auth()->id()) ? 'red' : 'none' }}"
         stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
    </svg>
    <span class="like-count">{{ $post->likes->count() }}</span>
</button>
