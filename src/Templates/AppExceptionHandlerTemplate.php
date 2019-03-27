<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/12
 * Time: 10:57
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContract;

class AppExceptionHandlerTemplate implements TemplateContract
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


use App\Exceptions\AppException;
use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Gzoran\ApiResponse\ApiResponseTrait;
use Illuminate\Http\Request;

class AppExceptionHandler implements ExceptionHandlerContract
{
    use ApiResponseTrait;

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function apiRender(Request \$request, \$exception)
    {
        /**
         * @var AppException \$exception
         */
        return \$this->response(\$exception->getResponse(), \$exception->getHttpStatus());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function pageRender(Request \$request, \$exception)
    {
        return response(500, 500);
    }
}

EOF;
    }
}
