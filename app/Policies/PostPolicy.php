<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return $post->user_id === auth()->user()->id || auth()->user()->role === 'admin';
    }

    public function edit(User $user, Post $post): bool
    {
        return $post->user_id === auth()->user()->id || auth()->user()->role === 'admin';
    }

    public function update(User $user, Post $post): bool
    {
        return $post->user_id === auth()->user()->id || auth()->user()->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $post->user_id === auth()->user()->id || auth()->user()->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $post->user_id === auth()->user()->id || auth()->user()->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $post->user_id === auth()->user()->id || auth()->user()->role === 'admin';
    }
}