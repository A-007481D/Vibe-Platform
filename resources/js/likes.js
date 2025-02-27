console.log('likes.js is loaded!');

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', async function () {
            const postId = this.dataset.postId;
            const icon = this.querySelector('.like-icon');
            const likeCountElement = this.querySelector('.like-count');

            try {
                const response = await fetch(`/like/${postId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) {
                    console.error('Error:', response.statusText);
                    return;
                }

                const data = await response.json();

                // Update UI
                if (data.liked) {
                    icon.classList.add('text-red-500');
                    icon.setAttribute('fill', 'red');
                } else {
                    icon.classList.remove('text-red-500');
                    icon.setAttribute('fill', 'none');
                }

                likeCountElement.textContent = data.likesCount;

            } catch (error) {
                console.error('Fetch error:', error);
            }
        });
    });
});
