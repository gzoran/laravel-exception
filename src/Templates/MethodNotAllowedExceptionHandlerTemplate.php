<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2019/1/14
 * Time: 16:17
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContract;

class MethodNotAllowedExceptionHandlerTemplate implements TemplateContract
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
use Gzoran\ApiResponse\ApiResponseTrait;
use Illuminate\Http\Request;

class MethodNotAllowedExceptionHandler implements ExceptionHandlerContract
{
    use ApiResponseTrait;

    /**
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function apiRender(Request \$request, \$exception)
    {
        return \$this->methodNotAllowed([
            config('exception.status.key') => config('exception.status.value'),
            'message' => 'Method Not Allowed',
        ]);
    }

    /**
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function pageRender(Request \$request, \$exception)
    {
        return response(405, 405);
    }
}
EOF;
    }
}
