<?php

namespace YWatchman\Panel_Console\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'YWatchman\Panel_Console\Controllers';

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        Route::prefix('/api/app/user')
            ->namespace($this->namespace.'\Api\User')
            ->group(__DIR__.'/../Routes/api-app-auth.php');
        Route::middleware(['api'])->prefix('/api/app/admin')
            ->namespace($this->namespace.'\Api\Admin')
            ->group(__DIR__.'/../Routes/api-app-admin.php');

        Route::middleware(['client-api'])->prefix('/api/app/user')
            ->namespace($this->namespace.'\Api\User')
            ->group(__DIR__.'/../Routes/api-app-user.php');
    }
}
