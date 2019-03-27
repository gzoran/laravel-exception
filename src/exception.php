<?php

/*
 * This file is part of the gzoran/laravel-exception.
 *
 * (c) gzoran <gzoran@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Exception Handler Mapping
    |--------------------------------------------------------------------------
    |
    | The mapping between exception and handler.
    |
    */

    'handlers' => [
        \App\Exceptions\AppException::class => \App\Exceptions\Handlers\AppExceptionHandler::class,
        \Illuminate\Auth\AuthenticationException::class => \App\Exceptions\Handlers\AuthenticationExceptionHandler::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class => \App\Exceptions\Handlers\HttpExceptionHandler::class,
        \Symfony\Component\Routing\Exception\MethodNotAllowedException::class => \App\Exceptions\Handlers\MethodNotAllowedExceptionHandler::class,
        \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class => \App\Exceptions\Handlers\MethodNotAllowedHttpExceptionHandler::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class => \App\Exceptions\Handlers\ModelNotFoundExceptionHandler::class,
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class => \App\Exceptions\Handlers\NotFoundHttpExceptionHandler::class,
        \Illuminate\Database\QueryException::class => \App\Exceptions\Handlers\QueryExceptionHandler::class,
        \Illuminate\Database\Eloquent\RelationNotFoundException::class => \App\Exceptions\Handlers\RelationNotFoundExceptionHandler::class,
        \Illuminate\Validation\UnauthorizedException::class => \App\Exceptions\Handlers\UnauthorizedExceptionHandler::class,
        \Illuminate\Validation\ValidationException::class => \App\Exceptions\Handlers\ValidationExceptionHandler::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Base Exception Handler
    |--------------------------------------------------------------------------
    |
    | Once they don't match any Exception, it will be used.
    |
    */
    'base_exception_handler' => App\Exceptions\Handlers\ExceptionHandler::class,

    /*
    |--------------------------------------------------------------------------
    | Api Url Start String
    |--------------------------------------------------------------------------
    |
    | Define urls start string and then mandatory return a api response.
    |
    */
    'api_starts_with' => [
        '/api',
    ],

    /*
    |--------------------------------------------------------------------------
    | Api status
    |--------------------------------------------------------------------------
    |
    | Define the key and error value of api status.
    |
    */
    'status' => [
        'key' => 'status',
        'value' => 0,
    ],
];
