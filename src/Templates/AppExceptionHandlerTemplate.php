<?php

/*
 * This file is part of the gzoran/laravel-exception.
 *
 * (c) gzoran <gzoran@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gzoran\Exception\Templates;

use Gzoran\Exception\Contracts\TemplateContract;

class AppExceptionHandlerTemplate implements TemplateContract
{
    /**
     * @author Mike <zhengzhe94@gmail.com>
     *
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
        // You can return the response in need.
    }
}

EOF;
    }
}
