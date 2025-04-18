<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

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
        $this->localConfigurations();
        $this->productionConfigurations();

        /**
         * Implicitly grant "Administrator" role all permissions
         *
         * This works in the app by using gate-related functions like auth()->user->can() and @can()
         *
         * @see https://spatie.be/docs/laravel-permission/v6/basic-usage/super-admin#content-gatebefore
         */
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Administrator') ? true : null;
        });
    }

    private function localConfigurations()
    {
        /**
         * Strict mode
         *
         * - Prevent lazy loading
         * - Prevent silently discarding attributes
         * - Prevent accessing missing attributes
         *
         * @see https://laravel-news.com/shouldbestrict
         */
        Model::shouldBeStrict(app()->isLocal());

        if (app()->isLocal()) {
            RequestException::dontTruncate();
        }
    }

    private function productionConfigurations()
    {
        URL::forceHttps(app()->isProduction());

        /**
         * Prohibit destructive database commands
         *
         * Prohibits: db:wipe, migrate:fresh, migrate:refresh, and migrate:reset
         *
         * @see https://laravel-news.com/prevent-destructive-commands-from-running-in-laravel-11
         */
        DB::prohibitDestructiveCommands(app()->isProduction());
    }
}
