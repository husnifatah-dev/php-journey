<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

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
        Model::preventLazyLoading(! app()->isProduction());

        Model::preventSilentlyDiscardingAttributes(! app()->isProduction());

        Model::preventAccessingMissingAttributes(! app()->isProduction());
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });
        
        Event::listen(Login::class, function ($event) {
            $event->user->update([
                'last_login_at' => now()
            ]);
        });
    }
}
