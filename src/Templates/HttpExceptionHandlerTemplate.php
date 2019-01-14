<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2019/1/14
 * Time: 16:09
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContract;

class HttpExceptionHandlerTemplate implements TemplateContract
{

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return string
     */
    public function get()
    {
        return <<<EOF
<?php

namespace App\Exceptions\Handlers;

use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Gzoran\Http\ApiResponseTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HttpExceptionHandler implements ExceptionHandlerContract
{
    use ApiResponseTrait;

    /**
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function apiRender(Request \$request, \$exception)
    {
        /**
         * @var HttpException \$exception
         */
        return \$this->response([
            config('exception.status.key') => config('exception.status.value'),
            'message' => \$exception->getMessage(),
        ], \$exception->getStatusCode(), \$exception->getHeaders());
    }

    /**
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function pageRender(Request \$request, \$exception)
    {
        return false;
    }
}

EOF;
    }
}
