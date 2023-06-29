<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReplyPolicy
{
    public function update(User $user, Reply $reply): bool
    {
        return $user->id === $reply->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Reply $reply): bool
    {
        return $user->id === $reply->user_id || $user->role === 'admin';
    }
}
