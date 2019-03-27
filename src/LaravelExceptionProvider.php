<?php

/*
 * This file is part of the gzoran/laravel-exception.
 *
 * (c) gzoran <gzoran@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gzoran\Exception;

use Gzoran\Exception\Commands\ExceptionInit;
use Gzoran\Exception\Commands\MakeExceptionHandler;
use Illuminate\Support\ServiceProvider;

class LaravelExceptionProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
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
            __DIR__.'/exception.php' => config_path('exception.php'),
        ]);
    }

    /**
     * Register services.
     */
    public function register()
    {
        //
    }
}
