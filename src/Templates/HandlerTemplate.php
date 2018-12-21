<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/20
 * Time: 16:54
 */

namespace Gzoran\Exception\Templates;

use Gzoran\Exception\Contracts\TemplateContract;

class HandlerTemplate implements TemplateContract
{
    /**
     * @var string
     */
    private $namespace = '';

    /**
     * @var string
     */
    private $className;

    public function __construct($namespace, $className)
    {
        if ($namespace != '') {
            $this->namespace = 'namespace ' . $namespace . ';';
        }
        $this->className = $className;
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return string
     */
    public function get()
    {
        return <<<EOF
<?php

{$this->namespace}

use Exception;
use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Gzoran\Http\ApiResponseTrait;
use Illuminate\Http\Request;

class {$this->className} implements ExceptionHandlerContract
{
    use ApiResponseTrait;

    /**
     * @param Request \$request
     * @param \$exception
     * @return mixed
     */
    public function apiRender(Request \$request, \$exception)
    {
        return \$this->internalServerError([
            'status'  => 0,
            'message' => 'Internal Server Error',
            'errors'  => [],
        ]);
    }

    /**
     * @param Request \$request
     * @param Exception \$exception
     * @return mixed
     */
    public function pageRender(Request \$request, Exception \$exception)
    {
        return response(500, 500);
    }
}
EOF;
    }
}
