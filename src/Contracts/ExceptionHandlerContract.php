<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/4
 * Time: 17:32
 */

namespace Gzoran\Exception\Contracts;


use Exception;
use Illuminate\Http\Request;

interface ExceptionHandlerContract
{
    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request $request
     * @param $exception
     * @return mixed
     */
    public function apiRender(Request $request, $exception);

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request $request
     * @param Exception $exception
     * @return mixed
     */
    public function pageRender(Request $request, Exception $exception);
}
