<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Roles' => 'App\Policies\RolePolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Todo' => 'App\Policies\TodoPolicy',
        'App\Models\ObservacionesTodo' => 'App\Policies\ObservacionTodoPolicyPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('view-deleted-projects', function ($user) {
            return $user->role === 'admin';
        });
        /* Gate::define('create-projects', 'App\Policies\ProjectPolicy@create'); */
    }
}
