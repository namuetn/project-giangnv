<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        Gate::define('check-admin', function ($user) {
            return $user->isAdmin();
        });

        
    }
}
