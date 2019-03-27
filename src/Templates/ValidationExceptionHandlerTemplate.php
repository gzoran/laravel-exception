<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2019/1/14
 * Time: 17:29
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContract;

class ValidationExceptionHandlerTemplate implements TemplateContract
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
use Illuminate\Validation\ValidationException;

class ValidationExceptionHandler implements ExceptionHandlerContract
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
         * @var ValidationException \$exception
         */
        return \$this->unprocessableEntity([
            config('exception.status.key') => config('exception.status.value'),
            'message' => 'The given data was invalid',
            'errors'  => \$exception->errors(),
        ]);
    }

    /**
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
