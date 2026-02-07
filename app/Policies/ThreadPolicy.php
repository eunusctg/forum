<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    public function view(?User $user, Thread $thread): bool
    {
        return !$thread->trashed() || ($user && $user->roles->contains('slug', 'moderator'));
    }

    public function update(User $user, Thread $thread): bool
    {
        return $thread->user_id === $user->id || $user->roles->contains('slug', 'admin');
    }
}
