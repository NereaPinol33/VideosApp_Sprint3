<?php

namespace App\Policies;

use App\Models\User;

class VideoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return $user ? true : false;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('teacher');
    }

    public function update(User $user, $video)
    {
        return $user->hasRole('admin') || ($user->hasRole('teacher') && $video->author_id == $user->id);
    }

    public function delete(User $user, $video)
    {
        return $user->hasRole('admin') || ($user->hasRole('teacher') && $video->author_id == $user->id);
    }
}
