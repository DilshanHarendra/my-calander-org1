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
            'App\Repositories\Account\AccountEloquentRepository');

        $this->app->bind(
            'App\Repositories\User\UserRepositoryInterface',
            'App\Repositories\User\UserEloquentRepository');

        $this->app->bind(
            'App\Repositories\Calendar\CalendarRepositoryInterface',
            'App\Repositories\Calendar\CalendarEloquentRepository');

        $this->app->bind(
            'App\Repositories\Calendar\SubscriberRepositoryInterface',
            'App\Repositories\Calendar\SubscriberEloquentRepository');


        $this->app->bind(
            'App\Repositories\Event\EventRepositoryInterface',
            'App\Repositories\Event\EventEloquentRepository');

        $this->app->bind(
            'App\Repositories\Event\InvitationRepositoryInterface',
            'App\Repositories\Event\InvitationEloquentRepository');

        $this->app->bind(
            'App\Repositories\Event\RegistrationRepositoryInterface',
            'App\Repositories\Event\RegistrationEloquentRepository');

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
