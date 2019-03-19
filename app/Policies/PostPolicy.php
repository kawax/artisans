<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Model\User $user
     * @param  \App\Model\Post $post
     *
     * @return mixed
     */
    public function view(?User $user, Post $post)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Model\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Model\User $user
     * @param  \App\Model\Post $post
     *
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Model\User $user
     * @param  \App\Model\Post $post
     *
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\Model\User $user
     * @param  \App\Model\Post $post
     *
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\Model\User $user
     * @param  \App\Model\Post $post
     *
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
