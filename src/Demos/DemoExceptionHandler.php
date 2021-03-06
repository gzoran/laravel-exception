<?php

/*
 * This file is part of the gzoran/laravel-exception.
 *
 * (c) gzoran <gzoran@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gzoran\Exception\Demos;

use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Illuminate\Http\Request;

class DemoExceptionHandler implements ExceptionHandlerContract
{
    /**
     * @author Mike <zhengzhe94@gmail.com>
     *
     * @param Request $request
     * @param $exception
     *
     * @return mixed
     */
    public function apiRender(Request $request, $exception)
    {
        return 'api';
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     *
     * @param Request $request
     * @param $exception
     *
     * @return mixed
     */
    public function pageRender(Request $request, $exception)
    {
        return 'page';
    }
}
