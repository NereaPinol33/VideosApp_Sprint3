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
        return $user->hasPermissionTo('view videos');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create videos');
    }

    public function update(User $user, $video)
    {
        return $user->hasPermissionTo('edit videos') && ($user->hasRole('admin') || $video->author_id == $user->id);
    }

    public function delete(User $user, $video)
    {
        return $user->hasPermissionTo('delete videos') && ($user->hasRole('admin') || $video->author_id == $user->id);
    }
}
