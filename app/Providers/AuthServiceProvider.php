<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Policies\UserRolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->user_role->role->role === 'admin';
        });

        Gate::define('pimpinan', function (User $user) {
            return $user->user_role->role->role == 'pimpinan';
        });

        Gate::define('keuangan', function (User $user) {
            return $user->user_role->role->role == 'keuangan';
        });

        Gate::define('karyawan', function (User $user) {
            return $user->user_role->role->role == 'karyawan';
        });
    }
}
