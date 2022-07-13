<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //  Delete a Post
    //  Takes in the currently authenticated user
    //  Also takes in the model we want to work with/delete
    public function delete(User $user, Post $post)
    {
        //  If the post is owned by the currently authenticated user
        return $user->id === $post->user_id;
    }
}
