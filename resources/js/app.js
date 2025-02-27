import './likes';
import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

let userId = window.Laravel.userId;

window.Echo.private('user.' + userId)
    .listen('FriendRequestSent', (event) => {
        console.log('Friend request sent to:', event.user);
        // Update UI or trigger a notification based on the event
        alert(`Friend request sent to ${event.user.name}`);
    });

