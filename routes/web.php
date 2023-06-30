<?php

use App\Models\User;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::any('/openai', function () {
    $result = OpenAI::completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => 'PHP is',
    ]);
    echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
});

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
    Auth::login($user);
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/post', [PostController::class, 'create'])->name('post');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('avatar.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('ticket', TicketController::class);
    // Route::resource('reply', ReplyController::class);

    Route::post('/reply/{ticket}', [ReplyController::class, 'store'])->name('reply.store');
    Route::get('/reply/{ticket}/{reply}', [ReplyController::class, 'edit'])->name('reply.edit');
    Route::patch('/reply/{reply}', [ReplyController::class, 'update'])->name('reply.update');
    Route::delete('/reply/{reply}', [ReplyController::class, 'destroy'])->name('reply.destroy');

});

require __DIR__.'/auth.php';