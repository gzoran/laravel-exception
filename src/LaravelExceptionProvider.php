<?php

namespace Gzoran\Exception;

use Gzoran\Exception\Commands\ExceptionInit;
use Gzoran\Exception\Commands\MakeExceptionHandler;
use Illuminate\Support\ServiceProvider;

class LaravelExceptionProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ExceptionInit::class,
                MakeExceptionHandler::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/exception.php' => config_path('exception.php'),
        ]);

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
