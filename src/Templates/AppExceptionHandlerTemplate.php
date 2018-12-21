<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/12
 * Time: 10:57
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContracts;

class AppExceptionHandlerTemplate implements TemplateContracts
{

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return string
     */
    public function get()
    {
        return <<<EOF
<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/6
 * Time: 9:43
 */

namespace App\Exceptions\Handlers;


use Exception;
use App\Exceptions\AppException;
use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Gzoran\Http\ApiResponseTrait;
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
         * @var \$exception AppException
         */
        return \$this->response(\$exception->getResponse(), \$exception->getHttpStatus());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
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
