<?php

namespace App\Providers;

use App\Models\Thread;
use App\Policies\ThreadPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [Thread::class => ThreadPolicy::class];

    public function boot(): void
    {
        Gate::define('admin-access', fn ($user) => $user->roles()->whereIn('slug', ['super-admin', 'admin', 'moderator'])->exists());
    }
}
