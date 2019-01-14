<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2019/1/14
 * Time: 17:16
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContract;

class RelationNotFoundExceptionHandlerTemplate implements TemplateContract
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
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Http\Request;

class RelationNotFoundExceptionHandler implements ExceptionHandlerContract
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
         * @var RelationNotFoundException \$exception
         */
        return \$this->notFound([
            config('exception.status.key') => config('exception.status.value'),
            'message' => 'Not Found',
            'errors'  => [
                \$exception->relation => 'Relation not found'
            ],
        ]);
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
