<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/20
 * Time: 14:57
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
        App\Exceptions\AppException::class => App\Exceptions\Handlers\AppExceptionHandler::class,
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
        '/api'
    ],

];
