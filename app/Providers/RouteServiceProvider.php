<?php

namespace App\Providers;

use App\Models\Calendar\Calendar;
use App\Models\Event\Event;
use App\Models\Tenant\Account;
use App\Models\Tenant\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();


        Route::bind('account', function ($value, $route) {
            return $this->getModel(Account::class, $value);
        });

        Route::bind('user', function ($value, $route) {
            return $this->getModel(User::class, $value);
        });

        Route::bind('event', function ($value, $route) {
            return $this->getModel(Event::class, $value);
        });

        Route::bind('calendar', function ($value, $route) {
            return $this->getModel(Calendar::class, $value);
        });

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }


    /**
     * @param $model
     * @param $routeKey
     * @return mixed
     */
    private function getModel($model, $routeKey)
    {
        $id = \Hashids::connection($model)->decode($routeKey)[0] ?? null;
        $modelInstance = resolve($model);

        return  $modelInstance->findOrFail($id);
    }
}
