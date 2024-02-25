<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
  * Determine whether the user can view the model.
  *
  * @param  \App\Models\User|null  $user
  * @param  \App\Models\Post  $post
  * @return \Illuminate\Auth\Access\Response|bool
  */
    public function view(?User $user, Post $post)
    {
        if ($post->published_at) {
            return true;
        }

        return $user && $user->is($post->author);
    }

    /**
     * Determine whether the user can view the post's author.
     *
     * @param  \App\Models\User|null  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAuthor(?User $user, Post $post)
    {
        return $this->view($user, $post);
    }

    /**
     * Determine whether the user can view the post's comments.
     *
     * @param  \App\Models\User|null  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewComments(?User $user, Post $post)
    {
        return $this->view($user, $post);
    }

    /**
     * Determine whether the user can view the post's tags.
     *
     * @param  \App\Models\User|null  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewTags(?User $user, Post $post)
    {
        return $this->view($user, $post);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

        /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Post $post)
    {
        return $user->is($post->author);
    }
}
