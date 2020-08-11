<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Account\AccountRepositoryInterface',
            'App\Repositories\Account\AccountRepository');

        $this->app->bind(
            'App\Repositories\User\UserRepositoryInterface',
            'App\Repositories\User\UserRepository');

        $this->app->bind(
            'App\Repositories\Calendar\CalendarRepositoryInterface',
            'App\Repositories\Calendar\CalendarRepository');

        $this->app->bind(
            'App\Repositories\Event\EventRepositoryInterface',
            'App\Repositories\Event\EventRepository');

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
