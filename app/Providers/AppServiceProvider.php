<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\User;
use App\Policies\ShortUrlPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
        Gate::define('create-short-url', [ShortUrlPolicy::class, 'create']);
        Gate::define('invite-user', function (User $user) {
            return in_array($user->role, [UserRole::SuperAdmin, UserRole::Admin]);
        });
    }
}
