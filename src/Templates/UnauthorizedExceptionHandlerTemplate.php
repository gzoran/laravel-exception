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

class UnauthorizedExceptionHandlerTemplate implements TemplateContract
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

use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Gzoran\ApiResponse\ApiResponseTrait;
use Illuminate\Http\Request;

class UnauthorizedExceptionHandler implements ExceptionHandlerContract
{
    use ApiResponseTrait;

    /**
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function apiRender(Request \$request, \$exception)
    {
        return \$this->unauthorized([
            config('exception.status.key') => config('exception.status.value'),
            'message' => 'Unauthorized',
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
