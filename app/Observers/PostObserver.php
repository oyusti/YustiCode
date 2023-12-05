<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{

    /**
     * Handle the Post "creating" event.
     */
    public function creating(Post $post)
    {
        if(!app()->runningInConsole()){
            $post->user_id = auth()->user()->id;
        }
    }

    public function updating(Post $post)
    {
        if($post->published && !$post->published_at){
            $post->published_at = now();
        }
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
