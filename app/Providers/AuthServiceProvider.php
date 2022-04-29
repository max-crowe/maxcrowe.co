<?php

namespace App\Providers;

use App\Models\User;
use App\Rules\MinimumEntropy;
use App\Rules\Printable;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register bindings.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserProvider::class, function ($app) {
            return $app->makeWith(EloquentUserProvider::class, [
                'model' => User::class
            ]);
        });
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Set default password rules
        Password::defaults(function () {
            return Password::min(env('AUTH_PASSWORD_MINIMUM_LENGTH', 8))->rules([
                new Printable,
                new MinimumEntropy((float)env('AUTH_PASSWORD_MINIMUM_ENTROPY', 3))
            ]);
        });
    }
}
