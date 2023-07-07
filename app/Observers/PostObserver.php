<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        cache()->forget('index_posts');
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        cache()->forget('index_posts');
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        cache()->forget('index_posts');
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        cache()->forget('index_posts');
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        cache()->forget('index_posts');
    }
}
