<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
   public function author(User $user, Post $post): bool
   {
       return $user->id === $post->user_id;
   }
}
