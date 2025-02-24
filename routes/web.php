<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserSearchController;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['PATCH', 'PUT'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/friends', [FriendController::class, 'index'])->name('friends');
    Route::get('/search', [UserSearchController::class, 'index'])->name('search.index');

    Route::bind('request', function ($value) {
        return FriendRequest::where('id', $value)->firstOrFail();
    });
    Route::post('/friend-request/send/{receiverId}', [FriendRequestController::class, 'sendRequest'])->name('friend-request.send');
    Route::post('/friend-request/accept/{request}', [FriendRequestController::class, 'acceptRequest'])->whereUuid('request')->name('friend-request.accept');
    Route::post('/friend-request/reject/{request}', [FriendRequestController::class, 'rejectRequest'])->whereUuid('request')->name('friend-request.reject');
    Route::post('/friend-request/cancel/{request}', [FriendRequestController::class, 'cancelRequest'])->whereUuid('request')->name('friend-request.cancel');
    Route::delete('/friend/unfriend/{user}', [FriendController::class, 'unfriend'])->name('friend.unfriend');

    Route::get('/friend-requests', [FriendRequestController::class, 'showRequests'])->name('friend-requests');
});

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});




// Route::get('/test-email', function () {
//     Mail::raw('This is a test email from Vibe.', function ($message) {
//         $message->to('labidabdelmalek@gmail.com')
//             ->subject('Test Email')
//             ->from('no-reply@vibe.com', 'Vibe');
//     });

//     return 'Test email sent!';
// });


require __DIR__ . '/auth.php';
