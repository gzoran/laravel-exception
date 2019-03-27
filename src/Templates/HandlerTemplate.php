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
        if ('' != $namespace) {
            $this->namespace = 'namespace '.$namespace.';';
        }
        $this->className = $className;
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     *
     * @return string
     */
    public function get()
    {
        return <<<EOF
<?php

{$this->namespace}

use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Gzoran\ApiResponse\ApiResponseTrait;
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
