<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    $user = User::firstOrCreate(['email' => $user->email], [
        'name' => $user->name? $user -> name : $user->nickname,
        'email' => $user ->email,
        'password' => Hash::make('password'),
    ]);
    auth()->login($user);
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::middleware(['admin'])->group(function() {
        Route::resource('user', UserController::class);
    });

    Route::resource('post', PostController::class);
    Route::patch('ticket/{ticket}/status', [TicketController::class, 'update_status'])->name('ticket.update.status');
    Route::resource('ticket', TicketController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('avatar.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::post('/reply/{ticket}', [ReplyController::class, 'store'])->name('reply.store');
    Route::get('/reply/{reply}', [ReplyController::class, 'edit'])->name('reply.edit');
    Route::patch('/reply/{reply}', [ReplyController::class, 'update'])->name('reply.update');
    Route::delete('/reply/{reply}', [ReplyController::class, 'destroy'])->name('reply.destroy');

});

require __DIR__.'/auth.php';
