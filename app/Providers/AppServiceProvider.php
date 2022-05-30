<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Utilities\FriendlyNameResolver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Main navigation
        View::share('navRoutes', [
            'home',
            'projects',
            'contact'
        ]);
        View::share('friendlyNameResolver', new FriendlyNameResolver);
    }
}
