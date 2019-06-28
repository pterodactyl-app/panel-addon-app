<?php

namespace YWatchman\Panel_Console\Providers;

use Illuminate\Support\ServiceProvider;
use YWatchman\Panel_Console\Providers\RouteServiceProvider;

use YWatchman\Panel_Console\Contracts\Daemon\FileRepositoryInterface;
use YWatchman\Panel_Console\Repositories\Daemon\FileRepository;

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
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
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
