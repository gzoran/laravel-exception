<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/12
 * Time: 11:12
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContract;

class ExceptionHandlerTemplate implements TemplateContract
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

use Exception;
use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Gzoran\ApiResponse\ApiResponseTrait;
use Illuminate\Http\Request;

class ExceptionHandler implements ExceptionHandlerContract
{
    use ApiResponseTrait;

    /**
     * @var bool
     */
    private \$isDebug;

    /**
     * ExceptionHandler constructor.
     */
    public function __construct()
    {
        \$this->isDebug = config('app.debug');
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function apiRender(Request \$request, \$exception)
    {
        /**
         * @var Exception \$exception
         */
        \$errors['info'] = \$exception->getMessage();
        if (\$this->isDebug) {
            \$errors['exception'] = get_class(\$exception);
            \$errors['file']      = \$exception->getFile();
            \$errors['line']      = \$exception->getLine();
            \$errors['trace']     = \$exception->getTrace();
        }

        return \$this->internalServerError([
            config('exception.status.key') => config('exception.status.value'),
            'message' => 'Internal Server Error',
            'errors'  => \$errors,
        ]);
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function pageRender(Request \$request, \$exception)
    {
        // You can return the response in need.
    }
}
EOF;
    }
}
