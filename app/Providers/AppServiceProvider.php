<?php

namespace App\Providers;

use App\Models\User;
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
        Gate::define ('viewAdmin', function (User $user){
            if ($user->role === 'admin'){
                return true;
            };
        });
        Gate::define ('viewAnalyst', function (User $user){
            if ($user->role === 'analyst'){
                return true;
            };
        });
        Gate::define ('viewBroker', function (User $user){
            if ($user->role === 'broker'){
                return true;
            };
        });
        Gate::define ('viewInspector', function (User $user){
            if ($user->role === 'inspector'){
                return true;
            };
        });
        
        
    }
}
