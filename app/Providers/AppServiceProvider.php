<?php

namespace App\Providers;

use App\Services\SaveBase64ToFileService;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();

        $this->app->bind(SaveBase64ToFileService::class,function($app){
            return new SaveBase64ToFileService();
        });

        $this->app->bind(
            'App\Repositories\Account\AccountRepositoryInterface',
            'App\Repositories\Account\AccountEloquentRepository');

        $this->app->bind(
            'App\Repositories\Subscription\SubscriptionRepositoryInterface',
            'App\Repositories\Subscription\SubscriptionEloquentRepository');


        $this->app->bind(
            'App\Repositories\Invite\InviteRepositoryInterface',
            'App\Repositories\Invite\InviteEloquentRepository');


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

        $this->app->bind(
            'App\Repositories\Address\AddressRepositoryInterface',
            'App\Repositories\Address\AddressEloquentRepository');

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
