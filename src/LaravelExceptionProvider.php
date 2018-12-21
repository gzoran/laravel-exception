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
            __DIR__ . '/configs/exception.php' => config_path('exception.php'),
        ], 'exception');

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
