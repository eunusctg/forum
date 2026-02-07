<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('threads.{threadId}', fn ($user, int $threadId) => $user->can('view-thread', $threadId));
Broadcast::channel('users.{id}', fn ($user, int $id) => $user->id === $id);
