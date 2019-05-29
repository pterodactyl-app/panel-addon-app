<?php

namespace YWatchman\Panel_Console\Providers;

use Illuminate\Support\ServiceProvider;
use YWatchman\Panel_Console\Providers\RouteServiceProvider;

class PanelConsoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
