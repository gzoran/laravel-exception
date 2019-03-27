<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2019/3/27
 * Time: 14:31
 */

namespace Gzoran\Exception\Demos;

use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Illuminate\Http\Request;

class DemoExceptionHandler implements ExceptionHandlerContract
{

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request $request
     * @param $exception
     * @return mixed
     */
    public function apiRender(Request $request, $exception)
    {
        return 'api';
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request $request
     * @param $exception
     * @return mixed
     */
    public function pageRender(Request $request, $exception)
    {
        return 'page';
    }
}